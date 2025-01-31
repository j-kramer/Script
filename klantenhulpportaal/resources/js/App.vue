<template>
    <h1 class="font-bold text-3xl">Klantenhulpportaal</h1>
    <nav>
        <RouterLink :to="{name: 'home'}">Home</RouterLink>
    </nav>
    <main>
        <RouterView />
    </main>
</template>
