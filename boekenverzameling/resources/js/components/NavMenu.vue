<template>
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
</template>
