<script setup lang="ts">
import AuthorList from "../components/AuthorList.vue";
import { fetchAuthors, getAllAuthors } from "../store";

fetchAuthors();
const authors = getAllAuthors;
</script>

<template>
    <AuthorList :authors="authors" />
</template>
