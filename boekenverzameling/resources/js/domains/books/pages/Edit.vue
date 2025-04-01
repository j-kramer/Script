<script setup lang="ts">
import { useRouter, useRoute } from "vue-router";
import BookForm from "../components/BookForm.vue";
import { getBookByID, updateBookByID } from "../store";
import { NewBook } from "../types";

const router = useRouter();
const route = useRoute();

const bookId = route.params.id.toString();
const book = getBookByID(bookId);

function submit(newBook: NewBook) {
    updateBookByID(bookId, newBook);
    router.push({ name: "overview" });
}
</script>

<template>
    <BookForm :book="book" @submit="submit" />
</template>
