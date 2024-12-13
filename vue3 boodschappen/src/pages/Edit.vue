<script setup>
import {useRoute} from 'vue-router';
import {getGroceryById, updateGrocery} from '@/store/Groceries';
import GroceryForm from '@/components/GroceryForm.vue';

const route = useRoute();

const oldGrocery = getGroceryById(route.params.id);
</script>

<template>
    <h2>Edit grocery</h2>
    <GroceryForm :grocery="oldGrocery" @submit="grocery => updateGrocery(route.params.id, grocery)" />
</template>
