<script setup>
import {reactive} from 'vue';
import GroceriesTable from './components/GroceriesTable.vue';

const boodschappenlijst = reactive([
    {
        name: 'Brood',
        price: 1.0,
        ammount: 0,
    },
    {
        name: 'Broccoli',
        price: 0.99,
        ammount: 0,
    },
    {
        name: 'Krentebollen',
        price: 1.2,
        ammount: 0,
    },
    {
        name: 'Noten',
        price: 2.99,
        ammount: 0,
    },
]);
</script>

<template>
    <GroceriesTable v-model="boodschappenlijst" />
</template>

<style scoped></style>
