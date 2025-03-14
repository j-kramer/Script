<template>
    <table class="border-collapse table-auto w-full">
        <thead>
            <tr>
                <th class="text-left">ID</th>
                <th class="text-left">Status</th>
                <th class="text-left">Titel</th>
                <th class="text-left">Categorieën</th>
                <th class="text-left">Aangemaakt op</th>
                <th class="text-left">Laatste update op</th>
            </tr>
        </thead>
        <tbody v-if="tickets">
            <tr v-for="ticket in tickets" :key="ticket.id">
                <td class="text-left">{{ ticket.id }}</td>
                <td class="text-left">{{ ticket.status }}</td>
                <td class="text-left">{{ ticket.title }}</td>
                <td class="text-left"><CategoryLabelList :category-ids="ticket.categories" /></td>
                <td class="text-left">{{ new Date(ticket.created_at).toLocaleString() }}</td>
                <td class="text-left">{{ new Date(ticket.updated_at).toLocaleString() }}</td>
            </tr>
        </tbody>
    </table>
</template>

<script setup lang="ts">
import type {Ticket} from '../types';

import {categoryStore} from 'domains/categories';
import CategoryLabelList from 'domains/categories/components/CategoryLabelList.vue';

defineProps<{
    tickets: Readonly<Ticket>[];
}>();

categoryStore.actions.getAll();
</script>
