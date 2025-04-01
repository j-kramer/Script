<script setup lang="ts">
import {ref} from 'vue';

import FormGroup from 'components/FormGroup.vue';
import ButtonLayout from 'components/layouts/ButtonLayout.vue';
import {sendResetPasswordEmail} from 'services/auth';
import {goBack} from 'services/router';

const email = ref('');
</script>

<template>
    <form
        class="max-w-md mx-auto"
        @submit.prevent="
            sendResetPasswordEmail(email);
            email = '';
        "
    >
        <ButtonLayout>
            <FormGroup name="email">
                <label for="email">Email:</label>
                <input id="email" v-model.trim="email" required type="email" class="border" />
            </FormGroup>
            <template #buttons>
                <button class="bg-gray-100 px-2" type="button" @click="goBack">Terug</button>
                <button class="bg-gray-100 px-2" type="submit">Verzenden</button>
            </template>
        </ButtonLayout>
    </form>
</template>
