<script setup lang="ts">
import type {LoginCredentials} from 'services/auth/types';

import FormGroup from 'components/FormGroup.vue';
import ButtonLayout from 'components/layouts/ButtonLayout.vue';
import {login} from 'services/auth';

const credentials: LoginCredentials = {
    email: '',
    password: '',
    rememberMe: true,
};
</script>

<template>
    <form
        class="max-w-md mx-auto"
        @submit.prevent="
            login(credentials);
            credentials.password = '';
        "
    >
        <ButtonLayout>
            <FormGroup name="email">
                <label for="email">Email:</label>
                <input id="email" v-model.trim="credentials.email" required type="email" class="border" />
            </FormGroup>
            <FormGroup>
                <label for="password">Password:</label>
                <input id="password" v-model.trim="credentials.password" required type="password" class="border" />
            </FormGroup>
            <FormGroup>
                <label for="remember">Remember me:</label>
                <input id="password" v-model="credentials.rememberMe" type="checkbox" />
            </FormGroup>
            <template #buttons>
                <button class="bg-gray-100 px-2">Login</button>
            </template>
        </ButtonLayout>
    </form>
</template>
