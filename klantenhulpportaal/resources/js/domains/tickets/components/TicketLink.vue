<template>
    <RouterLink :to="createLocation(TICKET_DOMAIN_NAME + SHOW_PAGE_NAME, ticket.id)">{{ ticket.title }}</RouterLink>
</template>

<script setup lang="ts">
import type {Ticket} from '../types';

import {createLocation} from 'services/router';
import {SHOW_PAGE_NAME} from 'services/router/factory';

import {TICKET_DOMAIN_NAME} from '..';

defineProps<{
    ticket: Readonly<Ticket>;
}>();
</script>
