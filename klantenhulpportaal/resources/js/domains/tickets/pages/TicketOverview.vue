<script setup lang="ts">
import type {New} from 'services/store/types';

import {defineAsyncComponent} from 'vue';

import {getLoggedInUser, isAdmin} from 'services/auth';
import {destroyErrors} from 'services/error';
import {formModal} from 'services/modal';
import {successToast} from 'services/toast';

import {ticketStore} from '..';
import AdminTicketTable from '../components/AdminTicketTable.vue';
import TicketTable from '../components/TicketTable.vue';
import {Status, type Ticket} from '../types';

ticketStore.actions.getAll();

const addTicket = function () {
    destroyErrors();
    formModal(
        {
            title: '',
            content: '',
            creator_id: getLoggedInUser().id,
            assignee_id: null,
            status: Status.pending,
            categories: [],
            created_at: 0,
            updated_at: 0,
        },
        defineAsyncComponent(() => import('../components/TicketForm.vue')),
        async (editedTicket: New<Ticket>) => {
            await ticketStore.actions.create(editedTicket);
            successToast('Ticket aangemaakt');
        },
    );
};
</script>

<template>
    <button class="bg-gray-100 mb-2 px-2" @click="addTicket">Nieuwe ticket aanmaken</button>
    <AdminTicketTable v-if="isAdmin" :tickets="ticketStore.getters.all.value" />
    <TicketTable v-else :tickets="ticketStore.getters.all.value" />
</template>
