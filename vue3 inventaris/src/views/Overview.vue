<script setup>
import InventoryTable from '../components/InventoryTable.vue';
import { getInventory } from '../store/inventory'

const inventory = getInventory;
</script>

<template>
  <main>
    <InventoryTable :inventory="inventory" />
  </main>
</template>
