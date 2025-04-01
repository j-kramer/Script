<template>
    <div
        class="flex flex-row m-2 w-fit"
        :class="[variants[toast.variant], toast.show ? 'show' : 'hide']"
        style="z-index: 9999"
    >
        <button class="flex-none" @click="emit('hide')">
            <Close />
        </button>
        <div class="flex-none px-1" style="background-color: rgba(255, 255, 255, 0.5)">
            {{ toast.message }}
        </div>
    </div>
</template>

<script setup lang="ts">
import type {Toast} from './types';

import Close from 'components/icons/Close.vue';

defineProps<{toast: Toast}>();

const emit = defineEmits<{
    hide: [void];
}>();

const variants = {
    danger: 'bg-red-100',
    info: 'bg-blue-100',
    success: 'bg-green-100',
};
</script>
