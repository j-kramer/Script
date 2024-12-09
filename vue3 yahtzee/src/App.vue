<script setup>
import {ref} from 'vue';

import ScoreTable from './components/ScoreTable.vue';
import ThrownDices from './components/ThrownDices.vue';

const dice = ref([1,1,1,1,1]);
</script>

<template>
    <ScoreTable :dice="dice" />
    <ThrownDices v-model="dice" />
</template>

<style scoped>
#app {
    min-width: none;
    max-width: 400px;
    margin: 0px auto;
    text-align: center;
}
</style>
