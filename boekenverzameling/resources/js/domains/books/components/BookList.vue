<script setup lang="ts">
const props = defineProps<{
    books: Book[];
}>();
</script>
<template>
    <ul>
        <li v-for="book in books">{{ book.cover_path }} -{{ book.title }}</li>
    </ul>
</template>
