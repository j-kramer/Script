<script setup lang="ts">
import type {RegisterData} from 'services/auth/types';
import type {Ref} from 'vue';

import {ref} from 'vue';

import FormGroup from 'components/FormGroup.vue';
import ButtonLayout from 'components/layouts/ButtonLayout.vue';
import {goToLoginPage, register} from 'services/auth';

const newUser: Ref<RegisterData> = ref({
    first_name: '',
    last_name: '',
    email: '',
    phone_number: '',
    password: '',
    password_confirmation: '',
});

const submit = function () {
    register(newUser.value);
    newUser.value.password = '';
    newUser.value.password_confirmation = '';
};
</script>

<template>
    <form @submit.prevent="submit">
        <ButtonLayout>
            <FormGroup name="first_name">
                <label for="firstName">Voornaam:</label>
                <input id="firstName" v-model.trim="newUser.first_name" required class="border" />
            </FormGroup>
            <FormGroup name="last_name">
                <label for="lastName">Achternaam:</label>
                <input id="lastName" v-model.trim="newUser.last_name" required class="border" />
            </FormGroup>
            <FormGroup name="email">
                <label for="email">Email:</label>
                <input id="email" v-model.trim="newUser.email" required type="email" class="border" />
            </FormGroup>
            <FormGroup name="phone_number">
                <label for="phonenumber">Telefoon nummer:</label>
                <input id="phonenumber" v-model.trim="newUser.phone_number" type="tel" required class="border" />
            </FormGroup>
            <FormGroup name="password">
                <label for="password">Wachtwoord:</label>
                <input id="password" v-model.trim="newUser.password" required type="password" class="border" />
            </FormGroup>
            <FormGroup>
                <label for="password_confirmation">Herhaal wachtwoord:</label>
                <input
                    id="password_confirmation"
                    v-model.trim="newUser.password_confirmation"
                    required
                    type="password"
                    class="border"
                />
            </FormGroup>
            <template #buttons>
                <button class="bg-gray-50 px-2" type="button" @click="goToLoginPage()">Annuleren</button>
                <button class="bg-gray-100 px-2" type="submit">Registreren</button>
            </template>
        </ButtonLayout>
    </form>
</template>
