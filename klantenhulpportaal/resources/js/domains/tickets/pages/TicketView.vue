<template>
    <div v-if="ticket" class="space-y-2">
        <div>
            <h2 class="font-semibold leading-tight text-xl">{{ ticket.title }}</h2>
            <small class="mr-1 text-gray-500 text-sm">
                Aangemaakt {{ creatorText }} {{ dateText }} {{ editedText }} #{{ ticket.id }}
            </small>
            <br />
            <span>Status: {{ fmtStatus(ticket.status) }}</span>
            <button @click="editStatus(ticket)"><Edit /></button>
            <br />
            <span v-if="ticket.categories.length">
                Categorieën:
                <CategoryLabelList :category-ids="ticket.categories" />
            </span>
        </div>

        <div>
            {{ ticket.content }}
        </div>
    </div>
    <span v-else>Loading ticket...</span>
</template>

<script setup lang="ts">
import type {Ticket} from '../types';
import type {Updatable} from 'services/store/types';

import {computed, defineAsyncComponent} from 'vue';

import Edit from 'components/icons/Edit.vue';
import {categoryStore} from 'domains/categories';
import CategoryLabelList from 'domains/categories/components/CategoryLabelList.vue';
import {userStore} from 'domains/users';
import {beautifyDate} from 'helpers/date';
import {getLoggedInUser, isAdmin} from 'services/auth';
import {destroyErrors} from 'services/error';
import {formModal} from 'services/modal';
import {getCurrentRouteId} from 'services/router';
import {successToast} from 'services/toast';

import {fmtStatus, ticketStore} from '..';

const id = getCurrentRouteId();

categoryStore.actions.getAll();
ticketStore.actions.getById(id);
if (isAdmin.value) userStore.actions.getAll();

const ticket = ticketStore.getters.byId(id);

/*
 * Byline computed values
 */
const creatorText = computed(() => {
    if (!ticket || ticket.value.creator_id === getLoggedInUser().id) return '';

    // check if the user is loaded yet
    const creator = userStore.getters.byId(ticket.value.creator_id);
    if (!creator) return '';

    return `door ${creator.value.fullName}`;
});

const dateText = computed(() => {
    if (!ticket) return;

    return `op ${beautifyDate(ticket.value.created_at)}`;
});

const editedText = computed(() => {
    if (!ticket || ticket.value.created_at === ticket.value.updated_at) return '';

    return '· edited';
});

/*
 * Modals
 */

const editStatus = function (ticket: Ticket) {
    destroyErrors();
    formModal(
        ticket,
        defineAsyncComponent(() => import('../components/TicketStatusForm.vue')),
        async (editedTicket: Updatable<Ticket>) => {
            await ticketStore.actions.update(ticket.id, editedTicket);
            successToast('Status aangepast');
        },
    );
};
</script>
