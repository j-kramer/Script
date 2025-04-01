<script setup>
import {computed} from 'vue';
import {RouterLink} from 'vue-router';
import {removeGrocery} from '../store/Groceries';
const props = defineProps(['groceries']);

// TODO: overweeg een array.reduce functie
// antwoord: done
const totalPrice = computed(() =>
    props.groceries.reduce((total, item) => {
        let number = item.amount ?? 0;
        // ignore the product on non-positive quantities
        if (number > 0) {
            total += item.price * number;
        }
        return total;
    }, 0),
);
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
