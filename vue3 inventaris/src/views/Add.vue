<script setup>
import { ref } from 'vue'
import { useRouter } from 'vue-router'
import InventoryItemForm from '@/components/InventoryItemForm.vue'
import { addInventoryItem } from '@/store/inventory'

const router = useRouter()

const newItem = ref({
  name: '',
  minimumAmount: 0,
  actualAmount: 0,
})

function submit(item) {
  addInventoryItem(item)
  router.push({ name: 'overview' })
}
</script>

<template>
  <main>
    <InventoryItemForm :item="newItem" @submit="submit" />
  </main>
</template>
