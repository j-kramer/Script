<script setup lang="ts">
import type {User} from '../types';
import type {Updatable} from 'services/store/types';

import {defineAsyncComponent} from 'vue';

import Delete from 'components/icons/Delete.vue';
import Edit from 'components/icons/Edit.vue';
import PaginatedTable from 'components/PaginatedTable.vue';
import {checkIfLoggedIn, getLoggedInUser} from 'services/auth';
import {destroyErrors} from 'services/error';
import {confirmModal, formModal} from 'services/modal';
import {successToast} from 'services/toast';

import {userStore} from '..';

userStore.actions.getAll();

const editUser = function (user: User) {
    destroyErrors();
    formModal(
        user,
        defineAsyncComponent(() => import('../components/UserForm.vue')),
        async (editedUser: Updatable<User>) => {
            await userStore.actions.update(user.id, editedUser);
            successToast('Gebruiker aangepast');
            // if we updated data of ourself, renew loggedInUser data
            if (user.id === getLoggedInUser().id) checkIfLoggedIn();
        },
    );
};

const deleteUser = async function (user: User) {
    const confirmed = await confirmModal(`Weet je zeker dat je ${user.fullName} wilt verwijderen?`, 'Verwijderen');
    if (!confirmed) return;
    await userStore.actions.delete(user.id);
    successToast('Gebruiker verwijderd');
};
</script>

<template>
    <PaginatedTable :items="userStore.getters.all.value" sorting-key="id">
        <template #headers>
            <th class="text-left">Voornaam</th>
            <th class="text-left">Achternaam</th>
            <th class="text-left">E-mail</th>
            <th class="text-left">Telefoonnummer</th>
            <th class="text-left">Rol</th>
        </template>
        <template #item="user">
            <td class="text-left">{{ user.first_name }}</td>
            <td class="text-left">{{ user.last_name }}</td>
            <td class="text-left">{{ user.email }}</td>
            <td class="text-left">{{ user.phone_number }}</td>
            <td class="text-left">{{ user.is_admin ? 'Admin' : 'Gebruiker' }}</td>
        </template>
        <template #actions="user">
            <button @click="editUser(user)"><Edit /></button>
            <button @click="deleteUser(user)"><Delete /></button>
        </template>
    </PaginatedTable>
</template>
