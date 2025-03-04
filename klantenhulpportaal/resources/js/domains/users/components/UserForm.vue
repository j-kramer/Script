<template>
    <form @submit.prevent="emit('submit', editable)">
        <ButtonLayout>
            <FormGroup name="first_name">
                <label for="firstName">Voornaam:</label>
                <input id="firstName" v-model.trim="editable.first_name" required class="border" />
            </FormGroup>
            <FormGroup name="last_name">
                <label for="lastName">Achternaam:</label>
                <input id="lastName" v-model.trim="editable.last_name" required class="border" />
            </FormGroup>
            <FormGroup name="email">
                <label for="email">Email:</label>
                <input id="email" v-model.trim="editable.email" required type="email" class="border" />
            </FormGroup>
            <FormGroup name="phone_number">
                <label for="phonenumber">Telefoon nummer:</label>
                <input id="phonenumber" v-model.trim="editable.phone_number" type="tel" required class="border" />
            </FormGroup>
            <FormGroup name="is_admin">
                <label for="role">Heeft admin rol:</label>
                <input id="role" v-model="editable.is_admin" type="checkbox" />
            </FormGroup>
            <template #buttons>
                <button class="bg-gray-50 px-2" type="button" @click="emit('cancel')">Annuleren</button>
                <button class="bg-gray-100 px-2" type="submit">Gebruiker bewaren</button>
            </template>
        </ButtonLayout>
    </form>
</template>

<script setup lang="ts">
import type {User} from '../types';
import type {New} from 'services/store/types';

import {ref} from 'vue';

import FormGroup from 'components/FormGroup.vue';
import ButtonLayout from 'components/layouts/ButtonLayout.vue';
import {deepCopy} from 'helpers/copy';

const props = defineProps<{form: New<User>}>();

const emit = defineEmits<{
    (event: 'submit', data: New<User>): void;
    (event: 'cancel'): void;
}>();

const editable = ref(deepCopy(props.form));
</script>
