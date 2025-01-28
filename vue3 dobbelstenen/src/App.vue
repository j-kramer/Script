<script setup>
import {ref, computed} from 'vue';

const dice = ref([]);

// TODO: gebruik Engelse namen
function gooi() {
    dice.value = [];

    for (let index = 0; index < 8; index++) {
        dice.value.push(Math.floor(Math.random() * 6) + 1);
    }
}

const diceCounts = computed(() => {
    let count = {
        1: 0,
        2: 0,
        3: 0,
        4: 0,
        5: 0,
        6: 0,
    };

    dice.value.forEach(element => {
        count[element]++;
    });

    return count;
});
</script>

<template>
    <div>
        <button @click="gooi">Gooi!</button>
        <table>
            <thead>
                <tr>
                    <th>Getal</th>
                    <th>Aantal</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(count, index) in diceCounts" :key="index">
                    <th>{{ index }}</th>
                    <td class="aantal">{{ count }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<style scoped>
div {
    text-align: center;
}

button {
    margin-bottom: 20px;
}

table {
    border-collapse: collapse;
    margin: auto;
}

thead {
    border-bottom: 2px solid;
    padding-right: 10px;
}

tr {
    border-bottom: 1px solid;
}

th {
    padding-right: 1rem;
}
</style>
