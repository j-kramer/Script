<template>
    <label for="categories" class="mr-1">Categorieën:</label>
    <select id="categories" v-model="selection" multiple class="border">
        <option v-for="(category, index) in categories" :key="index" :value="category.id">
            {{ category.name }}
        </option>
    </select>
</template>

<script setup lang="ts">
import {categoryStore} from '..';

categoryStore.actions.getAll();
const categories = categoryStore.getters.all;
const selection = defineModel<number[]>();
</script>
