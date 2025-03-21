<template>
    <PaginatedTable :items="tickets" sorting-key="created_at" reverse>
        <template #headers>
            <th class="text-left">ID</th>
            <th class="text-left">Status</th>
            <th class="text-left">Titel</th>
            <th class="text-left">Categorieën</th>
            <th class="text-left">Aangemaakt op</th>
            <th class="text-left">Laatste update op</th>
        </template>
        <template #item="ticket">
            <td class="text-left">{{ ticket.id }}</td>
            <td class="text-left">{{ fmtStatus(ticket.status) }}</td>
            <td class="text-left">{{ ticket.title }}</td>
            <td class="text-left"><CategoryLabelList :category-ids="ticket.categories" /></td>
            <td class="text-left">{{ beautifyDate(new Date(ticket.created_at)) }}</td>
            <td class="text-left">{{ beautifyDate(new Date(ticket.updated_at)) }}</td>
        </template>
    </PaginatedTable>
</template>

<script setup lang="ts">
import type {Ticket} from '../types';

import PaginatedTable from 'components/PaginatedTable.vue';
import {categoryStore} from 'domains/categories';
import CategoryLabelList from 'domains/categories/components/CategoryLabelList.vue';
import {beautifyDate} from 'helpers/date';

import {fmtStatus} from '..';


defineProps<{
    tickets: Readonly<Ticket>[];
}>();

categoryStore.actions.getAll();
</script>
