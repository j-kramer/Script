<script setup lang="ts">
import {computed} from 'vue';

import {categoryStore} from 'domains/categories';
import {sortBy} from 'helpers/sort';

const props = defineProps<{
    categoryIds: number[];
}>();

const categoryList = computed(() => {
    const categories = [];
    for (const id of props.categoryIds) {
        const category = categoryStore.getters.byId(id)?.value;
        if (category) categories.push(category);
    }

    return sortBy(categories, 'name');
});
</script>

<template>
    <template v-for="(category, index) in categoryList" :key="category.id">
        <span :title="category.description">{{ category.name }}</span>
        <span>{{ index < categoryList.length - 1 ? ', ' : '' }}</span>
    </template>
</template>
