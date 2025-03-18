<script setup lang="ts">
import type {Category} from '../types';
import type {New, Updatable} from 'services/store/types';

import {defineAsyncComponent} from 'vue';

import Delete from 'components/icons/Delete.vue';
import Edit from 'components/icons/Edit.vue';
import PaginatedTable from 'components/PaginatedTable.vue';
import {destroyErrors} from 'services/error';
import {confirmModal, formModal} from 'services/modal';
import {successToast} from 'services/toast';

import {categoryStore} from '..';

categoryStore.actions.getAll();

const addCategory = function () {
    destroyErrors();
    formModal(
        {name: '', description: ''},
        defineAsyncComponent(() => import('../components/CategoryForm.vue')),
        async (editedCategory: New<Category>) => {
            await categoryStore.actions.create(editedCategory);
            successToast('Categorie aangepast');
        },
    );
};

const editCategory = function (category: Category) {
    destroyErrors();
    formModal(
        category,
        defineAsyncComponent(() => import('../components/CategoryForm.vue')),
        async (editedCategory: Updatable<Category>) => {
            await categoryStore.actions.update(category.id, editedCategory);
            successToast('Categorie aangepast');
        },
    );
};

const deleteCategory = async function (category: Category) {
    const confirmed = await confirmModal(`Weet je zeker dat je ${category.name} wilt verwijderen?`, 'Verwijderen');
    if (!confirmed) return;
    await categoryStore.actions.delete(category.id);
    successToast('Categorie verwijderd');
};
</script>

<template>
    <button class="bg-gray-100 mb-2 px-2" @click="addCategory">Nieuwe categorie aanmaken</button>
    <PaginatedTable :items="categoryStore.getters.all.value" sorting-key="name">
        <template #headers>
            <th class="text-left">Naam</th>
            <th class="text-left">Beschrijving</th>
            <th class="text-center">Heeft Tickets</th>
        </template>
        <template #item="category">
            <td class="text-left">{{ category.name }}</td>
            <td class="text-left">{{ category.description }}</td>
            <td class="text-center">{{ category.tickets_count ? 'Ja' : 'Nee' }}</td>
        </template>
        <template #actions="category">
            <button @click="editCategory(category)"><Edit /></button>
            <button @click="deleteCategory(category)"><Delete /></button>
        </template>
    </PaginatedTable>
</template>
