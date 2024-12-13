import {ref, computed} from 'vue';
// State
let currentID = 5;
const groceries = ref([
    {
        id: 1,
        name: 'Brood',
        price: 1.0,
        amount: 1,
    },
    {
        id: 2,
        name: 'Broccoli',
        price: 0.99,
        amount: 0,
    },
    {
        id: 3,
        name: 'Krentebollen',
        price: 1.2,
        amount: 0,
    },
    {
        id: 4,
        name: 'Noten',
        price: 2.99,
        amount: 0,
    },
]);

// Getters
export const getAllGroceries = computed(() => groceries.value);
export const getGroceryById = id => computed(() => groceries.value.find(grocery => grocery.id == id));

// Actions
export const addGrocery = grocery => {
    grocery.id = currentID;
    currentID++;
    groceries.value.push(grocery);
};
export const updateGrocery = (id, grocery) => {
    let oldGrocery = groceries.value.find(grocery => grocery.id == id);
    oldGrocery.name = grocery.name;
    oldGrocery.price = grocery.price;
    oldGrocery.amount = grocery.amount;
};
export const removeGrocery = grocery => groceries.value.splice(groceries.value.indexOf(grocery), 1);
