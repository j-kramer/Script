<template>
    <form @submit.prevent="emit('submit', editable)">
        <ButtonLayout>
            <FormGroup name="title">
                <label for="title">Titel:</label>
                <input id="title" v-model.trim="editable.title" required class="border" />
            </FormGroup>
            <FormGroup name="content">
                <label for="content">Beschrijving:</label>
                <textarea id="content" v-model.trim="editable.content" required class="border" />
            </FormGroup>
            <FormGroup name="categories">
                <CategorySelectInput v-model="editable.categories" />
            </FormGroup>
            <template #buttons>
                <button class="bg-gray-100 px-2" type="button" @click="emit('cancel')">Annuleren</button>
                <button class="bg-gray-100 px-2" type="submit">Ticket bewaren</button>
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
import CategorySelectInput from 'domains/categories/components/CategorySelectInput.vue';
import {deepCopy} from 'helpers/copy';

const props = defineProps<{form: New<Ticket>}>();

const emit = defineEmits<{
    (event: 'submit', data: New<Ticket>): void;
    (event: 'cancel'): void;
}>();

const editable = ref(deepCopy(props.form));
</script>
