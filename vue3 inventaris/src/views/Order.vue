<script setup>
import InventoryOrder from '@/components/InventoryOrder.vue'
import { getInventory } from '@/store/inventory'

const inventory = getInventory
</script>

<template>
  <main>
    <InventoryOrder :inventory="inventory" />
  </main>
</template>
