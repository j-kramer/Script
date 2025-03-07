<script setup lang="ts">
import type {ResetPasswordData} from 'services/auth/types';
import type {Ref} from 'vue';

import {ref} from 'vue';

import FormGroup from 'components/FormGroup.vue';
import ButtonLayout from 'components/layouts/ButtonLayout.vue';
import {resetPassword, goToLoginPage} from 'services/auth';
import {getCurrentRouteQuery, getCurrentRouteToken} from 'services/router';

const data: Ref<ResetPasswordData> = ref({
    email: getCurrentRouteQuery().email,
    password: '',
    password_confirmation: '',
    token: getCurrentRouteToken(),
});
</script>

<template>
    <form
        class="max-w-md mx-auto"
        @submit.prevent="
            resetPassword(data);
            data.password = '';
            data.password_confirmation = '';
        "
    >
        <input type="hidden" name="token" :value="data.token" />

        <ButtonLayout>
            <FormGroup name="email">
                <label for="email">Email:</label>
                <input id="email" v-model.trim="data.email" required type="email" class="border" />
            </FormGroup>
            <FormGroup name="password">
                <label for="password">Wachtwoord:</label>
                <input id="password" v-model.trim="data.password" required type="password" class="border" />
            </FormGroup>
            <FormGroup>
                <label for="password_confirmation">Herhaal wachtwoord:</label>
                <input
                    id="password_confirmation"
                    v-model.trim="data.password_confirmation"
                    required
                    type="password"
                    class="border"
                />
            </FormGroup>
            <template #buttons>
                <button class="bg-gray-100 px-2" type="button" @click="goToLoginPage()">Cancel</button>
                <button class="bg-gray-100 px-2" type="submit">Reset</button>
            </template>
        </ButtonLayout>
    </form>
</template>
