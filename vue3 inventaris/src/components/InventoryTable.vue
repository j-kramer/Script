<script setup>
import { removeInventoryItem, updateAllInventoryAmounts } from '@/store/inventory'
import IconEdit from '@/components/icons/IconEdit.vue'
import IconDelete from './icons/IconDelete.vue'
import { useRouter } from 'vue-router'

const props = defineProps(['inventory'])

const router = useRouter()

const newAmounts = Array.from(props.inventory, (item) => item.actualAmount)
</script>

<template>
  <table>
    <thead>
      <tr>
        <th>Name</th>
        <th>Minimum</th>
        <th>Available</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      <tr v-for="(item, index) in inventory" :key="index">
        <td class="left">{{ item.name }}</td>
        <td>{{ item.minimumAmount }}</td>
        <td>
          <input v-model.number="newAmounts[index]" type="number" value="0" min="0" required />
        </td>
        <td>
          <button @click="router.push({ name: 'editItem', params: { id: item.id } })">
            <IconEdit />
          </button>
          <button @click="removeInventoryItem(item.id)"><IconDelete /></button>
        </td>
      </tr>
    </tbody>
  </table>
  <div>
    <button @click="updateAllInventoryAmounts(newAmounts)">Store available amounts</button>
  </div>
</template>

<style scoped>
table {
  text-align: center;
}

.left {
  text-align: left;
}

input {
  text-align: right;
}

th {
  border-bottom: 2px solid;
}

tr:nth-child(even) {
  background-color: var(--color-background-soft);
}

div {
  display: flex;
  flex-direction: row-reverse;
  padding-top: 5px;
}

button {
  margin-left: 0.5rem;
}
</style>
