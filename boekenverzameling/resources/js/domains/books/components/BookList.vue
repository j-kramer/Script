<script setup lang="ts">
import BookCard from "./BookCard.vue";
import type { Book } from "../types";

const props = defineProps<{
    books: Book[];
}>();
</script>

<template>
    <ul>
        <li v-for="(book, index) in books" :key="index">
            <BookCard :book="book" />
        </li>
    </ul>
</template>
