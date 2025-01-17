<script setup lang="ts">
import { fetchAuthors } from "../../authors/store";
import BookList from "../components/BookList.vue";
import { fetchBooks, getAllBooks } from "../store";

fetchAuthors();
fetchBooks();
const books = getAllBooks;
</script>

<template>
    <BookList :books="books" />
</template>
