<template>
    <h1 class="text-3xl font-bold">Klantenhulpportaal</h1>
    <nav>
        <RouterLink :to="{ name: 'home' }">Home</RouterLink>
    </nav>
    <main>
        <RouterView />
    </main>
</template>
