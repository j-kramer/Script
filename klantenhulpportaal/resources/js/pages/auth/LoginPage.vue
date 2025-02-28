<script setup lang="ts">
import type {LoginCredentials} from 'services/auth/types';

import ButtonLayout from 'components/layouts/ButtonLayout.vue';
import InputError from 'errors/InputError.vue';
import {login} from 'services/auth';
import {getErrorByProperty} from 'services/error';

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
            <div class="flex flex-row justify-between">
                <label for="email">Email:</label>
                <input id="email" v-model.trim="credentials.email" required type="email" class="border" />
            </div>
            <InputError v-if="getErrorByProperty('email')" :errors="getErrorByProperty('email').value" class="mt-2" />
            <div class="flex flex-row justify-between mt-2">
                <label for="password">Password:</label>
                <input id="password" v-model.trim="credentials.password" required type="password" class="border" />
            </div>
            <div class="flex flex-row justify-between mt-2">
                <label for="remember">Remember me:</label>
                <input id="password" v-model="credentials.rememberMe" type="checkbox" />
            </div>
            <template #buttons>
                <button class="bg-gray-100 px-2">Login</button>
            </template>
        </ButtonLayout>
    </form>
</template>
