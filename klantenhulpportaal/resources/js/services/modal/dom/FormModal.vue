<template>
    <Modal :show="!hideModal" :size="modal.size">
        <component :is="modal.component" :form="modal.form" @submit="submit" @cancel="close" />
    </Modal>
</template>

<script setup lang="ts">
import type {FormModalData} from '../types';

import {ref} from 'vue';

import Modal from './Modal.vue';

const props = defineProps<{modal: FormModalData}>();

const emit = defineEmits<{(event: 'hide'): void}>();

const hideModal = ref(false);

const close = () => {
    hideModal.value = true;
    emit('hide');
};

const submit = async (form: unknown) => {
    await props.modal.submitEvent(form);
    close();
};
</script>
