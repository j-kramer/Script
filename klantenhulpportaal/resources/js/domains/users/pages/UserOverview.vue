<script setup lang="ts">
import {userStore} from '..';

userStore.actions.getAll();
</script>

<template>
    <table class="border-collapse table-auto w-full">
        <thead>
            <tr>
                <th class="text-left">First Name</th>
                <th class="text-left">Last Name</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="user in userStore.getters.all.value" :key="user.id">
                <td class="text-left">{{ user.firstName }}</td>
                <td class="text-left">{{ user.lastName }}</td>
            </tr>
        </tbody>
    </table>
</template>
