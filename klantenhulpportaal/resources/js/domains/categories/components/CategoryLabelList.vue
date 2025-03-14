<script setup lang="ts">
import {computed} from 'vue';

import {categoryStore} from 'domains/categories';

const props = defineProps<{
    categoryIds: number[];
}>();

const categoryList = computed(() => {
    if (props.categoryIds.length > 0)
        return props.categoryIds.map((id: number) => categoryStore.getters.byId(id).value?.name).join(', ');

    return '';
});
</script>

<template>
    {{ categoryList }}
</template>
