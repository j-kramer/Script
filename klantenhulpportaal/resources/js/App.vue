<script setup lang="ts">
import {USER_DOMAIN_NAME} from 'domains/users';
import {getLoggedInUser, isLoggedIn, logout} from 'services/auth';
import {OVERVIEW_PAGE_NAME} from 'services/router/factory';
</script>

<template>
    <header>
        <h1 class="bg-gray-100 font-bold text-3xl">Klantenhulpportaal</h1>
        <nav v-if="isLoggedIn" class="bg-gray-50 flex flex-row justify-between">
            <div class="flex flex-row justify-evenly">
                <RouterLink :to="{name: 'home'}" class="mr-2">Home</RouterLink>
                <RouterLink :to="{name: USER_DOMAIN_NAME + OVERVIEW_PAGE_NAME}">Gebruikers</RouterLink>
            </div>
            <div>
                <span class="mr-2">{{ getLoggedInUser().firstName }} {{ getLoggedInUser().lastName }}</span>
                <button @click="logout">Logout</button>
            </div>
        </nav>
    </header>
    <main class="mt-2">
        <RouterView />
    </main>
</template>
