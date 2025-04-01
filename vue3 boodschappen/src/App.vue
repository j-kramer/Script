<script setup>
import {RouterLink, RouterView} from 'vue-router';
</script>

<template>
    <h1>Grocery List</h1>
    <nav>
        <!-- TODO: overweeg het gebruik van route names ipv url's, voor betere onderhoudbaarheid -->
        <!-- antwoord: done -->
        <RouterLink :to="{name: 'overview'}">Go to Home</RouterLink>
        <RouterLink :to="{name: 'add'}">Create a grocery list item</RouterLink>
    </nav>
    <main>
        <RouterView />
    </main>
</template>

<style lang="css" scoped>
nav > a {
    padding-right: 1rem;
}
</style>
