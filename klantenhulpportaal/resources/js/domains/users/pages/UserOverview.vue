<script setup lang="ts">
import {userStore} from '..';

userStore.actions.getAll();
</script>

<template>
    <table>
        <thead>
            <tr>
                <th>First Name</th>
                <th>Last Name</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="user in userStore.getters.all.value" :key="user.id">
                <td>{{ user.first_name }}</td>
                <td>{{ user.last_name }}</td>
            </tr>
        </tbody>
    </table>
</template>
