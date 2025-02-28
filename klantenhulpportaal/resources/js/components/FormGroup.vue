<template>
    <div class="flex flex-row justify-between mb-2">
        <slot />
    </div>
    <InputError v-if="name && getErrorByProperty(name)" :errors="getErrorByProperty(name).value" class="mb-2" />
</template>

<script setup lang="ts">
import InputError from 'errors/InputError.vue';
import {getErrorByProperty} from 'services/error';

defineProps<{name?: string}>();
</script>
