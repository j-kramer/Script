<script setup>
import {computed} from 'vue';
const products = defineModel();

const totalPrice = computed(() => {
    let total = 0;
    for (let product of products.value) {
        let number = product.ammount ?? 0;
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
            </tr>
        </thead>
        <tbody>
            <tr v-for="(product, index) in products" :key="index">
                <td class="productName">{{ product.name }}</td>
                <td>{{ product.price.toFixed(2) }}</td>
                <td>
                    <input v-model.number="product.ammount" type="number" value="0" min="0" />
                </td>
                <td>{{ (product.price * product.ammount).toFixed(2) }}</td>
            </tr>
        </tbody>
        <tfoot>
            <tr>
                <th scope="row" colspan="3">Totaal</th>
                <td>{{ totalPrice.toFixed(2) }}</td>
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

th,
td {
    border: 1px solid #888;
    padding: 10px;
}

th,
.productName {
    text-align: left;
}
</style>
