<template>
    <h1>Boekverzameling</h1>
    <nav>
        <RouterLink class="navLink" to="/">Boekenlijst</RouterLink>
        <RouterLink class="navLink" to="/create">Boek toevoegen</RouterLink>
        <RouterLink class="navLink" to="/authors">Auteurlijst</RouterLink>
        <RouterLink class="navLink" to="/authors/create"
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
