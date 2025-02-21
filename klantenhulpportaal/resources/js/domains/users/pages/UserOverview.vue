<script setup lang="ts">
import type {User} from '../types';

import Delete from 'components/icons/Delete.vue';
import {confirmModal} from 'services/modal';
import {successToast} from 'services/toast';

import {userStore} from '..';

userStore.actions.getAll();

const deleteUser = async function (user: User) {
    const confirmed = await confirmModal(
        `Weet je zeker dat je ${user.firstName} ${user.lastName} wilt verwijderen?`,
        'Verwijderen',
    );
    if (!confirmed) return;
    userStore.actions.delete(user.id);
    successToast('Gebruiker verwijderd');
};
</script>

<template>
    <table class="border-collapse table-auto w-full">
        <thead>
            <tr>
                <th class="text-left">Voornaam</th>
                <th class="text-left">Achternaam</th>
                <th class="text-left">E-mail</th>
                <th class="text-left">Telefoonnummer</th>
                <th class="text-left">Rol</th>
                <th>Acties</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="user in userStore.getters.all.value" :key="user.id">
                <td class="text-left">{{ user.firstName }}</td>
                <td class="text-left">{{ user.lastName }}</td>
                <td class="text-left">{{ user.email }}</td>
                <td class="text-left">{{ user.phonenumber }}</td>
                <td class="text-left">{{ user.isAdmin ? 'Admin' : 'Gebruiker' }}</td>
                <td class="flex flex-row justify-center">
                    <button @click="deleteUser(user)"><Delete /></button>
                </td>
            </tr>
        </tbody>
    </table>
</template>
