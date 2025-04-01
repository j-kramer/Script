<template>
    <table class="border-collapse table-auto w-full">
        <thead>
            <tr class="bg-gray-50">
                <slot name="headers" />
                <th v-if="$slots.actions">Acties</th>
            </tr>
        </thead>
        <tbody>
            <tr v-if="!items.length" class="col-span-full">niks gevonden</tr>
            <tr v-for="(item, index) in paginatedItems" :key="item.id" :class="index % 2 ? 'bg-gray-50' : ''">
                <slot name="item" v-bind="item" />
                <td v-if="$slots.actions" class="flex flex-row justify-center">
                    <slot name="actions" v-bind="item" />
                </td>
            </tr>
        </tbody>
    </table>
    <div v-if="maxPage != 1" class="flex justify-end mt-2 w-full">
        <button class="bg-gray-100" @click="previousPage">
            <Previous />
        </button>
        <span class="px-2">Page: {{ currentPage }} of {{ maxPage }}</span>
        <button class="bg-gray-100" @click="nextPage">
            <Next />
        </button>
    </div>
</template>

<script setup lang="ts" generic="T extends {id: number}">
import {computed, ref} from 'vue';

import {sortBy} from 'helpers/sort';

import Next from './icons/Next.vue';
import Previous from './icons/Previous.vue';

const {
    items,
    itemsPerPage = 15,
    sortingKey,
    reverse = false,
} = defineProps<{
    items: Readonly<T>[];
    itemsPerPage?: number;
    sortingKey?: keyof T;
    reverse?: boolean;
}>();

const currentPage = ref<number>(1);
const maxPage = computed(() => Math.floor(items.length / itemsPerPage) + 1);

const sortedItems = computed(() => {
    if (sortingKey) return sortBy(items, sortingKey, reverse);

    return items;
});

const previousPage = function () {
    if (currentPage.value > 1) currentPage.value--;
};

const nextPage = function () {
    if (currentPage.value < maxPage.value) currentPage.value++;
};

const paginatedItems = computed(() => {
    const start = (currentPage.value - 1) * itemsPerPage;
    const end = start + itemsPerPage;

    return sortedItems.value.slice(start, end);
});
</script>
