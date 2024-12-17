<script setup>
import { useRouter } from 'vue-router'
const props = defineProps(['item'])
defineEmits(['submit'])

const router = useRouter()

const newItem = Object.assign({}, props.item)
</script>

<template>
  <section>
    <div class="flexline">
      <label for="name">Name:</label>
      <input v-model.trim="newItem.name" required placeholder="Apples" id="name" />
    </div>
    <div class="flexline">
      <label for="minimumAmount">Minimum amount:</label>
      <input
        v-model.number="newItem.minimumAmount"
        type="number"
        value="0"
        min="0"
        required
        id="ninimumAmount"
      />
    </div>
    <div class="flexline">
      <label for="actualAmount">Actual amount:</label>
      <input
        v-model.number="newItem.actualAmount"
        type="number"
        value="0"
        min="0"
        required
        id="actualAmount"
      />
    </div>
    <div class="buttons">
      <button @click="router.back()">Cancel</button>
      <button @click="$emit('submit', newItem)">Store</button>
    </div>
  </section>
</template>

<style scoped>
.flexline {
  display: flex;
  flex-direction: row;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 0.5rem;
}

input {
  text-align: right;
}

.buttons {
  display: flex;
  flex-direction: row;
  justify-content: flex-end;
}

button {
  margin-left: 0.5rem;
}
</style>
