<template>
    <form @submit.prevent="emit('submit', editable)">
        <ButtonLayout>
            <FormGroup name="status">
                <StatusInput v-model="editable.status" />
            </FormGroup>
            <template #buttons>
                <button class="bg-gray-100 px-2" type="button" @click="emit('cancel')">Annuleren</button>
                <button class="bg-gray-100 px-2" type="submit">Status bewaren</button>
            </template>
        </ButtonLayout>
    </form>
</template>

<script setup lang="ts">
import type {Ticket} from '../types';
import type {New} from 'services/store/types';

import {ref} from 'vue';

import FormGroup from 'components/FormGroup.vue';
import ButtonLayout from 'components/layouts/ButtonLayout.vue';
import {deepCopy} from 'helpers/copy';

import StatusInput from './StatusInput.vue';

const props = defineProps<{form: New<Ticket>}>();

const emit = defineEmits<{
    (event: 'submit', data: New<Ticket>): void;
    (event: 'cancel'): void;
}>();

const editable = ref(deepCopy(props.form));
</script>
