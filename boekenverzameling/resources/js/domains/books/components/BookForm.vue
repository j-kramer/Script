<script setup lang="ts">
import { useRouter } from "vue-router";
import type { Book, NewBook } from "../types";
import { fetchAuthors, getAllAuthors } from "../../authors/store";

const props = defineProps<{
    book?: Book;
}>();
const emit = defineEmits<{ submit: [book: NewBook] }>();

const router = useRouter();

let newBook: NewBook;
if (props.book) {
    newBook = Object.assign({}, props.book) as NewBook;
} else {
    newBook = {
        title: "",
        author_id: "",
    };
}

function handleFileChange(event: Event) {
    const target = event.target as HTMLInputElement;
    if (target && target.files) newBook.cover = target.files[0];
}

// make sure authors are fetched, so the drop down is populated
fetchAuthors();
</script>

<template>
    <form>
        <div class="flexline">
            <label for="title">Title:</label>
            <input
                v-model.trim="newBook.title"
                required
                placeholder="1984"
                id="title"
            />
        </div>
        <div class="flexline">
            <label for="author">Author:</label>
            <select required v-model="newBook.author_id">
                <option
                    v-for="(author, index) in getAllAuthors"
                    :key="index"
                    :value="author.id"
                >
                    {{ author.name }}
                </option>
            </select>
        </div>
        <div class="flexline">
            <label for="cover">Cover:</label>
            <input
                @change="handleFileChange($event)"
                type="file"
                accept=".jpeg,.png,.jpg,.svg"
                required
                id="cover"
            />
        </div>
        <div class="buttons">
            <button @click="router.back()">Cancel</button>
            <button @click="$emit('submit', newBook)">Store</button>
        </div>
    </form>
</template>

<style scoped>
.flexline {
    display: flex;
    flex-direction: row;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 0.5rem;
}

input {
    text-align: right;
}

.buttons {
    display: flex;
    flex-direction: row;
    justify-content: flex-end;
}

button {
    margin-left: 0.5rem;
}
</style>
