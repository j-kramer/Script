<template>
    <form @submit.prevent="emit('submit', editable)">
        <ButtonLayout>
            <FormGroup name="name">
                <label for="name">Naam:</label>
                <input id="name" v-model.trim="editable.name" required class="border" />
            </FormGroup>
            <FormGroup name="description">
                <label for="description">Beschrijving:</label>
                <textarea id="description" v-model.trim="editable.description" required class="border" />
            </FormGroup>
            <template #buttons>
                <button class="bg-gray-100 px-2" type="button" @click="emit('cancel')">Annuleren</button>
                <button class="bg-gray-100 px-2" type="submit">Categorie bewaren</button>
            </template>
        </ButtonLayout>
    </form>
</template>

<script setup lang="ts">
import type {Category} from '../types';
import type {New} from 'services/store/types';

import {ref} from 'vue';

import FormGroup from 'components/FormGroup.vue';
import ButtonLayout from 'components/layouts/ButtonLayout.vue';
import {deepCopy} from 'helpers/copy';

const props = defineProps<{form: New<Category>}>();

const emit = defineEmits<{
    (event: 'submit', data: New<Category>): void;
    (event: 'cancel'): void;
}>();

const editable = ref(deepCopy(props.form));
</script>
