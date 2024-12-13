<script setup>
import {RouterLink, RouterView} from 'vue-router';
</script>

<template>
    <h1>Grocery List</h1>
    <nav>
        <RouterLink to="/">Go to Home</RouterLink>
        <RouterLink to="/create">Create a grocery list item</RouterLink>
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
