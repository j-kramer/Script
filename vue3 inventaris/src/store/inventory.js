import { ref, computed } from 'vue'
// State
let currentID = 8
const inventory = ref([
  {
    id: 1,
    name: 'Brood',
    minimumAmount: 1,
    actualAmount: 1,
  },
  {
    id: 2,
    name: 'Broccoli',
    minimumAmount: 1,
    actualAmount: 0,
  },
  {
    id: 3,
    name: 'Krentebollen',
    minimumAmount: 1,
    actualAmount: 4,
  },
  {
    id: 4,
    name: 'Noten',
    minimumAmount: 1,
    actualAmount: 0,
  },
  {
    id: 5,
    name: 'Appels',
    minimumAmount: 1,
    actualAmount: 0,
  },
  {
    id: 6,
    name: 'Peren',
    minimumAmount: 3,
    actualAmount: 1,
  },
  {
    id: 7,
    name: 'Bananen',
    minimumAmount: 2,
    actualAmount: 4,
  },
])

// Getters
export const getInventory = computed(() => inventory.value)
export const getInventoryItemById = (id) =>
  computed(() => inventory.value.find((item) => item.id == id))

// Actions
export const addInventoryItem = (item) => {
  item.id = currentID
  currentID++
  inventory.value.push(item)
}
export const updateInventoryItem = (id, item) => {
  let oldItem = inventory.value.find((item) => item.id == id)
  Object.assign(oldItem, item)
}
export const removeInventoryItem = (id) => {
  inventory.value = inventory.value.filter((item) => item.id != id)
}
