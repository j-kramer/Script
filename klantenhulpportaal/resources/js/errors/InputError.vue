<script setup lang="ts">
defineProps<{
    errors?: string[];
}>();
</script>

<template>
    <ul class="bg-red-100 space-y-1 text-sm">
        <li v-for="(error, index) in errors" :key="index">
            {{ error }}
        </li>
    </ul>
</template>
