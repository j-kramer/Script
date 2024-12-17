<script setup>
import { useRoute, useRouter } from 'vue-router'
import InventoryItemForm from '@/components/InventoryItemForm.vue'
import { getInventoryItemById, updateInventoryItem } from '@/store/inventory'

const router = useRouter()
const route = useRoute()

const oldItem = getInventoryItemById(route.params.id)
function submit(item) {
  updateInventoryItem(route.params.id, item)
  router.push({ name: 'overview' })
}
</script>

<template>
  <main>
    <h2>Edit</h2>
    <InventoryItemForm :item="oldItem" @submit="submit" />
  </main>
</template>
