<script setup lang="ts">
import BookCard from "./BookCard.vue";
import type { Book } from "../types";

const props = defineProps<{
    books: Book[];
}>();
</script>

<template>
    <ul v-if="books.length">
        <li v-for="(book, index) in books" :key="index">
            <BookCard :book="book" />
        </li>
    </ul>
    <p v-else>Er zitten geen boeken in de verzameling</p>
</template>
