<script setup>
const props = defineProps(['grocery']);
defineEmits(['submit']);

const newGrocery = Object.assign({}, props.grocery);
</script>

<template>
    <div>
        <label for="name">Name:</label>
        <input v-model.trim="newGrocery.name" required placeholder="Apples" id="name" />
        <br />
        <label for="price">Price:</label>
        <input v-model.number="newGrocery.price" required id="price" />
        <br />
        <label for="amount">Amount:</label>
        <input v-model.number="newGrocery.amount" type="number" value="0" min="0" required id="amount" />
        <button @click="$emit('submit', newGrocery)">Submit</button>
    </div>
</template>

<style scoped>
div {
    display: flex;
    flex-direction: column;
}

label {
    width: 1rem;
    display: block;
}

input {
    margin: 8px 0;
    padding: 12px 20px;
    text-align: right;
}

button {
    text-align: center;
}
</style>
