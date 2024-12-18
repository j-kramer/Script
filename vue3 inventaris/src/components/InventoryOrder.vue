<script setup>
import { computed } from 'vue'

const props = defineProps(['inventory'])

const missingInventory = computed(() => {
  let missing = []
  for (let item of props.inventory) {
    let difference = item.minimumAmount - item.actualAmount
    if (difference > 0) {
      missing.push({
        name: item.name,
        amount: difference,
      })
    }
  }
  return missing
})
</script>

<template>
  <table>
    <thead>
      <tr>
        <th>Name</th>
        <th>Amount required</th>
      </tr>
    </thead>
    <tbody>
      <tr v-for="(item, index) in missingInventory" :key="index">
        <td class="left">{{ item.name }}</td>
        <td>{{ item.amount }}</td>
      </tr>
    </tbody>
  </table>
</template>

<style scoped>
table {
  text-align: center;
}

.left {
  text-align: left;
}

th {
  border-bottom: 2px solid;
}

tr:nth-child(even) {
  background-color: var(--color-background-soft);
}
</style>
