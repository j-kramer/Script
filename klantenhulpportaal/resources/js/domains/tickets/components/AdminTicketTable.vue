<template>
    <FormGroup>
        <label for="role">Show Tickets of all users:</label>
        <input id="role" v-model="showAll" type="checkbox" />
    </FormGroup>
    <table class="border-collapse table-auto w-full">
        <thead>
            <tr>
                <th class="text-left">ID</th>
                <th class="text-left">Status</th>
                <th class="text-left">Titel</th>
                <th class="text-left">Aangemaakt door</th>
                <th class="text-left">Aangemaakt op</th>
                <th class="text-left">Laatste update op</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="ticket in filteredTickets" :key="ticket.id">
                <td class="text-left">{{ ticket.id }}</td>
                <td class="text-left">{{ ticket.status }}</td>
                <td class="text-left">{{ ticket.title }}</td>
                <td class="text-left">{{ userStore.getters.byId(ticket.creator_id).value?.fullName }}</td>
                <td class="text-left">{{ new Date(ticket.created_at).toLocaleString() }}</td>
                <td class="text-left">{{ new Date(ticket.updated_at).toLocaleString() }}</td>
            </tr>
        </tbody>
    </table>
</template>

<script setup lang="ts">
import type {Ticket} from '../types';

import {computed, ref} from 'vue';

import FormGroup from 'components/FormGroup.vue';
import {userStore} from 'domains/users';
import {getLoggedInUser} from 'services/auth';

const props = defineProps<{
    tickets: Readonly<Ticket>[];
}>();

const showAll = ref(true);

const filteredTickets = computed(() => {
    if (showAll.value) return props.tickets;

    return props.tickets.filter(ticket => ticket.creator_id === getLoggedInUser().id);
});

userStore.actions.getAll();
</script>
