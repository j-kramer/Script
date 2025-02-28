<template>
    <Modal :show="!hideModal" :size="modal.size">
        <component :is="modal.component" v-bind="modal.props" @hide="close" />
    </Modal>
</template>

<script setup lang="ts">
import type {ShowModalData} from '../types';

import {onMounted, ref} from 'vue';

defineProps<{modal: ShowModalData}>();

const emit = defineEmits<{(event: 'hide'): void}>();

const modalBody = ref<HTMLDivElement>();

const hideModal = ref(false);

const close = () => {
    hideModal.value = true;
    emit('hide');
};

onMounted(() => {
    if (modalTemplate.value?.children[0].classList.contains('modal-fullscreen') && modalBody.value)
        modalBody.value.style.padding = '0';
});
</script>
