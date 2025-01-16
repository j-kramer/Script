<script setup lang="ts">
import type { Book } from "../types";
import { useRouter } from "vue-router";
import IconEdit from "../../../icons/IconEdit.vue";

const props = defineProps<{
    book: Book;
}>();

const router = useRouter();
</script>

<template>
    <article class="card">
        <div>
            <img :src="'/' + book.cover_path" alt="book cover" />
        </div>
        {{ book.title }}
          <button @click="router.push({ name: 'editBook', params: { id: book.id } })">
            <IconEdit />
          </button>
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
