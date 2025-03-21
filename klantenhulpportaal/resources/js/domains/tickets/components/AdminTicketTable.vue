<template>
    <FormGroup>
        <label for="role">Show Tickets of all users:</label>
        <input id="role" v-model="showAll" type="checkbox" />
    </FormGroup>
    <PaginatedTable :items="filteredTickets" sorting-key="created_at" reverse>
        <template #headers>
            <th class="text-left">ID</th>
            <th class="text-left">Status</th>
            <th class="text-left">Titel</th>
            <th class="text-left">Categorieën</th>
            <th class="text-left">Aangemaakt door</th>
            <th class="text-left">Aangemaakt op</th>
            <th class="text-left">Laatste update op</th>
        </template>
        <template #item="ticket">
            <td class="text-left">{{ ticket.id }}</td>
            <td class="text-left">{{ ticket.status }}</td>
            <td class="text-left">{{ ticket.title }}</td>
            <td class="text-left"><CategoryLabelList :category-ids="ticket.categories" /></td>
            <td class="text-left">{{ userStore.getters.byId(ticket.creator_id).value?.fullName }}</td>
            <td class="text-left">{{ beautifyDate(new Date(ticket.created_at)) }}</td>
            <td class="text-left">{{ beautifyDate(new Date(ticket.updated_at)) }}</td>
        </template>
    </PaginatedTable>
</template>

<script setup lang="ts">
import type {Ticket} from '../types';

import {computed, ref} from 'vue';

import FormGroup from 'components/FormGroup.vue';
import PaginatedTable from 'components/PaginatedTable.vue';
import {categoryStore} from 'domains/categories';
import CategoryLabelList from 'domains/categories/components/CategoryLabelList.vue';
import {userStore} from 'domains/users';
import {beautifyDate} from 'helpers/date';
import {getLoggedInUser} from 'services/auth';

const props = defineProps<{
    tickets: Readonly<Ticket>[];
}>();

const showAll = ref(true);

const filteredTickets = computed(() => {
    if (showAll.value) return props.tickets;

    return props.tickets.filter(ticket => ticket.creator_id === getLoggedInUser().id);
});

categoryStore.actions.getAll();
userStore.actions.getAll();
</script>
