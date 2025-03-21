<script setup lang="ts">
import {isAdmin} from 'services/auth';

import {ticketStore} from '..';
import AdminTicketTable from '../components/AdminTicketTable.vue';
import TicketTable from '../components/TicketTable.vue';

ticketStore.actions.getAll();
</script>

<template>
    <AdminTicketTable v-if="isAdmin" :tickets="ticketStore.getters.all.value" />
    <TicketTable v-else :tickets="ticketStore.getters.all.value" />
</template>
