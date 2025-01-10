<script setup lang="ts">
import type { Book } from "../types";

const props = defineProps<{
    book: Book;
}>();
</script>

<template>
    <article class="card">
        <div>
            <img :src="'/' + book.cover_path" alt="book cover" />
        </div>
        {{ book.title }}
    </article>
</template>

<style lang="css" scoped>
.card {
    display: flex;
    flex-direction: row;
}

img {
    width: 5rem;
    height: 5rem;
}
</style>
