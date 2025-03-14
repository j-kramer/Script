<script setup lang="ts">
import type {Category} from '../types';

import {computed} from 'vue';

import Delete from 'components/icons/Delete.vue';
import {sortBy} from 'helpers/sort';
import {confirmModal} from 'services/modal';
import {successToast} from 'services/toast';

import {categoryStore} from '..';

categoryStore.actions.getAll();
const categories = computed(() => sortBy(categoryStore.getters.all.value, 'name'));

const deleteCategory = async function (category: Category) {
    const confirmed = await confirmModal(`Weet je zeker dat je ${category.name} wilt verwijderen?`, 'Verwijderen');
    if (!confirmed) return;
    await categoryStore.actions.delete(category.id);
    successToast('Categorie verwijderd');
};
</script>

<template>
    <table class="border-collapse table-auto w-full">
        <thead>
            <tr>
                <th class="text-left">Naam</th>
                <th class="text-left">Beschrijving</th>
                <th class="text-center">Heeft Tickets</th>
                <th>Acties</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="category in categories" :key="category.id">
                <td class="text-left">{{ category.name }}</td>
                <td class="text-left">{{ category.description }}</td>
                <td class="text-center">{{ category.tickets_count ? 'Ja' : 'Nee' }}</td>
                <td class="flex flex-row justify-center">
                    <button @click="deleteCategory(category)"><Delete /></button>
                </td>
            </tr>
        </tbody>
    </table>
</template>
