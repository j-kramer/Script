<script setup lang="ts">
import {computed} from 'vue';

import {categoryStore} from 'domains/categories';

const props = defineProps<{
    categoryIds: number[];
}>();

const categoryList = computed(() => props.categoryIds.map((id: number) => categoryStore.getters.byId(id)?.value));
</script>

<template>
    <template v-for="(category, index) in categoryList" :key="category.id">
        <span :title="category.description">{{ category.name }}</span>
        <span>{{ index < categoryList.length - 1 ? ', ' : '' }}</span>
    </template>
</template>
