<script setup lang="ts">
import {userStore} from '..';

userStore.actions.getAll();
</script>

<template>
    <table class="border-collapse table-auto w-full">
        <thead>
            <tr>
                <th class="text-left">Voornaam</th>
                <th class="text-left">Achternaam</th>
                <th class="text-left">E-mail</th>
                <th class="text-left">Rol</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="user in userStore.getters.all.value" :key="user.id">
                <td class="text-left">{{ user.firstName }}</td>
                <td class="text-left">{{ user.lastName }}</td>
                <td class="text-left">{{ user.email }}</td>
                <td class="text-left">{{ user.isAdmin ? 'Admin' : 'Gebruiker' }}</td>
            </tr>
        </tbody>
    </table>
</template>
