<template>
    <h1>Boekverzameling</h1>
    <!-- TODO: nav menu kan evt. in apart component -->
    <nav>
        <RouterLink class="navLink" to="/">Boekenlijst</RouterLink>
        <RouterLink class="navLink" :to="{ name: 'createBook' }"
            >Boek toevoegen</RouterLink
        >
        <RouterLink class="navLink" :to="{ name: 'authorOverview' }"
            >Auteurlijst</RouterLink
        >
        <RouterLink class="navLink" :to="{ name: 'createAuthor' }"
            >Auteur toevoegen</RouterLink
        >
    </nav>
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
