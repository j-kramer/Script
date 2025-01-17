<script setup lang="ts">
import { useRouter, useRoute } from "vue-router";
import AuthorForm from "../components/AuthorForm.vue";
import { getAuthorByID, updateAuthorByID } from "../store";
import { NewAuthor } from "../types";

const router = useRouter();
const route = useRoute();

let id: string;
if (typeof route.params.id == "string") {
    id = route.params.id;
} else {
    id = route.params.id[0];
}

const author = getAuthorByID(id);

function submit(newAuthor: NewAuthor) {
    updateAuthorByID(id, newAuthor);
    router.push({ name: "authorOverview" });
}
</script>

<template>
    <AuthorForm :author="author" @submit="submit" />
</template>
