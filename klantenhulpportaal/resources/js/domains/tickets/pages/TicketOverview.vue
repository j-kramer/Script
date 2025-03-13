<script setup lang="ts">
import {computed} from 'vue';

import {sortBy} from 'helpers/sort';
import {isAdmin} from 'services/auth';

import {ticketStore} from '..';
import AdminTicketTable from '../components/AdminTicketTable.vue';
import TicketTable from '../components/TicketTable.vue';

ticketStore.actions.getAll();

const tickets = computed(() => sortBy(ticketStore.getters.all.value, 'created_at', true));
</script>

<template>
    <AdminTicketTable v-if="isAdmin" :tickets="tickets" />
    <TicketTable v-else :tickets="tickets" />
</template>
