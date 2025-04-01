<script setup lang="ts">
import NavMenu from "./components/NavMenu.vue";
</script>

<template>
    <h1>Boekverzameling</h1>
    <NavMenu />
    <main>
        <RouterView />
    </main>
</template>

<style>
#app {
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
}

.navLink {
    padding-right: 1em;
}
</style>
