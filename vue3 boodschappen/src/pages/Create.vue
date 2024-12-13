<script setup>
import {addGrocery} from '@/store/Groceries';
import GroceryForm from '@/components/GroceryForm.vue';
const newGrocery = {name: '', price: 0, amount: 0};
</script>

<template>
    <h2>Create grocery</h2>
    <GroceryForm :grocery="newGrocery" @submit="grocery => addGrocery(grocery)" />
</template>
