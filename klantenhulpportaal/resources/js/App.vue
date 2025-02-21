<script setup lang="ts">
import {USER_DOMAIN_NAME} from 'domains/users';
import {OVERVIEW_PAGE_NAME} from 'services/router/factory';
</script>

<template>
    <header>
        <h1 class="bg-gray-100 font-bold text-3xl">Klantenhulpportaal</h1>
        <nav class="bg-gray-50 flex flex-row justify-between">
            <div>
                <RouterLink :to="{name: 'home'}">Home</RouterLink>
            </div>
            <div>
                <RouterLink :to="{name: USER_DOMAIN_NAME + OVERVIEW_PAGE_NAME}">Gebruikers</RouterLink>
            </div>
        </nav>
    </header>
    <main class="mt-2">
        <RouterView />
    </main>
</template>
