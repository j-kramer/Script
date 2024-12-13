<script setup>
import {getAllGroceries} from '@/store/Groceries';
import GroceriesTable from '@/components/GroceriesTable.vue';

const groceries = getAllGroceries;
</script>

<template>
    <GroceriesTable :groceries="groceries" />
</template>
