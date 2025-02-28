<template>
    <Modal :show="!hideModal" size="md">
        <ButtonLayout>
            <h5>{{ modal.message }}</h5>
            <template #buttons>
                <button class="bg-gray-50 px-2" @click="resolve(false)">
                    {{ modal.cancelButtonText }}
                </button>

                <button class="bg-gray-100 px-2" type="button" @click="resolve(true)">
                    {{ modal.okButtonText }}
                </button>
            </template>
        </ButtonLayout>
    </Modal>
</template>

<script setup lang="ts">
import type {ConfirmModalData} from '../types';

import {ref} from 'vue';

import ButtonLayout from 'components/layouts/ButtonLayout.vue';

import Modal from './Modal.vue';

const props = defineProps<{modal: ConfirmModalData}>();

const emit = defineEmits<{(event: 'hide'): void}>();

const hideModal = ref(false);

const close = () => {
    hideModal.value = true;
    emit('hide');
};

const resolve = (confirm: boolean) => {
    props.modal.resolver(confirm);
    close();
};
</script>
