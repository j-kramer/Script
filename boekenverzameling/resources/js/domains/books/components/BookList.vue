<script setup lang="ts">
const props = defineProps<{
    books: Book[];
}>();
</script>

<template>
    <ul>
        <li v-for="(book, index) in books" :key="index">
            <div>
                <img :src="'/' + book.cover_path" alt="book cover">
            </div>
            {{ book.title }}
        </li>
    </ul>
</template>

<style lang="css" scoped>
img {
    width: 5rem;
    height: 5rem;
}
</style>
