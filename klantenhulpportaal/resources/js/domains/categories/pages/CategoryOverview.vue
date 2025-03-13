<script setup lang="ts">
import {categoryStore} from '..';

categoryStore.actions.getAll();
const categories = computed(() => sortBy(categoryStore.getters.all.value, 'name'));

</script>

<template>
    <table class="border-collapse table-auto w-full">
        <thead>
            <tr>
                <th class="text-left">Naam</th>
                <th class="text-left">Beschrijving</th>
                <th>Acties</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="category in categories" :key="category.id">
                <td class="text-left">{{ category.name }}</td>
                <td class="text-left">{{ category.description }}</td>
                <td class="flex flex-row justify-center" />
            </tr>
        </tbody>
    </table>
</template>
