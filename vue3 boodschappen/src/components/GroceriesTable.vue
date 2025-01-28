<script setup>
import {computed} from 'vue';
import {RouterLink} from 'vue-router';
import {removeGrocery} from '../store/Groceries';
const props = defineProps(['groceries']);

const totalPrice = computed(() => {
    let total = 0;
    // TODO: overweeg een array.reduce functie
    for (let product of props.groceries) {
        let number = product.amount ?? 0;
        // ignore the product on negative quantities
        if (number < 0) {
            continue;
        }
        total += product.price * number;
    }

    return total;
});
</script>

<template>
    <table>
        <thead>
            <tr>
                <th scope="col">Product</th>
                <th scope="col">Prijs</th>
                <th scope="col">Aantal</th>
                <th scope="col">Subtotaal</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="(product, index) in groceries" :key="index">
                <td class="productName">{{ product.name }}</td>
                <td>{{ product.price.toFixed(2) }}</td>
                <td>{{ product.amount }}</td>
                <td>{{ (product.price * product.amount).toFixed(2) }}</td>
                <td>
                    <RouterLink :to="{name: 'edit', params: {id: product.id}}">Edit</RouterLink>
                    <button @click="removeGrocery(product)">Remove</button>
                </td>
            </tr>
        </tbody>
        <tfoot>
            <tr>
                <th scope="row" colspan="3">Totaal</th>
                <td>{{ totalPrice.toFixed(2) }}</td>
                <td></td>
            </tr>
        </tfoot>
    </table>
</template>

<style scoped>
table {
    font-family: sans-serif;
    border-collapse: collapse;
    text-align: right;
}

thead th {
    border-bottom: 2px solid #888;
}

th,
td {
    padding: 2px 10px;
}

th,
.productName {
    text-align: left;
}

tr:nth-child(even) {
    background-color: #efefef;
}
</style>
