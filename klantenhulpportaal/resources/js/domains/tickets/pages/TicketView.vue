<template>
    <div v-if="ticket" class="space-y-2">
        <div>
            <h2 class="font-semibold leading-tight text-xl">{{ ticket.title }}</h2>
            <small class="mr-1 text-gray-500 text-sm">
                Aangemaakt {{ creatorText }} {{ dateText }} {{ editedText }} #{{ ticket.id }}
            </small>
            <br />
            <span>Status: {{ fmtStatus(ticket.status) }}</span>
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
import {computed} from 'vue';

import {categoryStore} from 'domains/categories';
import CategoryLabelList from 'domains/categories/components/CategoryLabelList.vue';
import {userStore} from 'domains/users';
import {beautifyDate} from 'helpers/date';
import {getLoggedInUser, isAdmin} from 'services/auth';
import {getCurrentRouteId} from 'services/router';

import {fmtStatus, ticketStore} from '..';

const id = getCurrentRouteId();

ticketStore.actions.getById(id);
categoryStore.actions.getAll();
if (isAdmin.value) userStore.actions.getAll();

const ticket = ticketStore.getters.byId(id);

/*
 * Byline computed values
 */
const creatorText = computed(() => {
    if (!ticket || ticket.value.creator_id === getLoggedInUser().id) return '';

    return `door ${userStore.getters.byId(ticket.value.creator_id).value.fullName}`;
});

const dateText = computed(() => {
    if (!ticket) return;

    return `op ${beautifyDate(new Date(ticket.value.created_at))}`;
});

const editedText = computed(() => {
    if (!ticket || ticket.value.created_at === ticket.value.updated_at) return '';

    return '&middot; edited';
});
</script>
