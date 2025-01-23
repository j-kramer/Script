<script setup lang="ts">
import type { Book } from "../types";
import { useRouter } from "vue-router";
import IconEdit from "../../../icons/IconEdit.vue";
import IconDelete from "../../../icons/IconDelete.vue";
import { removeBook } from "../store";
import { getAuthorByID } from "../../authors/store";

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
        <div>
            <router-link :to="{ name: 'showBook', params: { id: book.id } }">
                {{ book.title }}
            </router-link>
            <br />
            <small
                >By {{ getAuthorByID(props.book.author_id).value?.name }}</small
            >
        </div>
        <div>
            <button
                @click="
                    router.push({ name: 'editBook', params: { id: book.id } })
                "
            >
                <IconEdit />
            </button>
            <button @click="removeBook(book.id)"><IconDelete /></button>
        </div>
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
