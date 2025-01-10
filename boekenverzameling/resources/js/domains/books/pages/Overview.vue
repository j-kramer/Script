<script setup lang="ts">
import BookList from "../components/BookList.vue";
import { fetchBooks, getAllBooks } from "../store";

fetchBooks();
const books = getAllBooks;
</script>

<template>
    <BookList :books="books" />
</template>
