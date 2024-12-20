<script setup lang="ts">
import BookList from "../components/BookList.vue";
import { getAllBooks } from "../store";

const books = getAllBooks();
</script>

<template>
    <BookList :books="books" />
</template>
