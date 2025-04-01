<template>
    <label for="assignee" class="mr-1">Toewijzen aan:</label>
    <select id="assignee" v-model="selection" class="border">
        <option :value="null">Niemand</option>
        <option v-for="(admin, index) in admins" :key="index" :value="admin.id">
            {{ admin.fullName }}
        </option>
    </select>
</template>

<script setup lang="ts">
import {userStore} from 'domains/users';

userStore.actions.getAll();
const admins = userStore.getters.all.value.filter(user => user.is_admin);
const selection = defineModel<number | null>();
</script>
