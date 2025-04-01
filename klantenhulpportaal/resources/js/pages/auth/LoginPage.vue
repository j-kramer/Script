<script setup lang="ts">
import type {LoginCredentials} from 'services/auth/types';
import type {Ref} from 'vue';

import {ref} from 'vue';

import FormGroup from 'components/FormGroup.vue';
import ButtonLayout from 'components/layouts/ButtonLayout.vue';
import {FORGOT_PASSWORD_ROUTE_NAME, login, REGISTER_ROUTE_NAME} from 'services/auth';

const credentials: Ref<LoginCredentials> = ref({
    email: '',
    password: '',
    rememberMe: true,
});
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
                <input id="remember" v-model="credentials.rememberMe" type="checkbox" />
            </FormGroup>
            <template #buttons>
                <RouterLink :to="{name: FORGOT_PASSWORD_ROUTE_NAME}">Wachtwoord vergeten</RouterLink>
                <RouterLink :to="{name: REGISTER_ROUTE_NAME}">Registreer hier</RouterLink>
                <button class="bg-gray-100 px-2" type="submit">Login</button>
            </template>
        </ButtonLayout>
    </form>
</template>
