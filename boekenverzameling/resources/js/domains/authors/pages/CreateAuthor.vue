<script setup lang="ts">
import { useRouter } from "vue-router";
import AuthorForm from "../components/AuthorForm.vue";
import { addAuthor } from "../store";
import { NewAuthor } from "../types";

const router = useRouter();

function submit(newAuthor: NewAuthor) {
    addAuthor(newAuthor);
    router.push({ name: "authorOverview" });
}
</script>

<template>
    <AuthorForm @submit="submit" />
</template>
