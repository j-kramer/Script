<script setup lang="ts">
import { useRouter } from "vue-router";
import BookForm from "../components/BookForm.vue";
import { addBook } from "../store";
import { NewBook } from "../types";

const router = useRouter();

function submit(newBook: NewBook) {
    addBook(newBook);
    router.push({ name: "overview" });
}
</script>

<template>
    <BookForm @submit="submit" />
</template>
