<script setup lang="ts">
import { useRouter } from "vue-router";
import type { Author, NewAuthor } from "../types";

const props = defineProps<{
    author?: Author;
}>();
const emit = defineEmits<{ submit: [author: NewAuthor] }>();

const router = useRouter();

let newAuthor: NewAuthor;
if (props.author) {
    newAuthor = Object.assign({}, props.author) as NewAuthor;
} else {
    newAuthor = {
        name: "",
    };
}
</script>

<template>
    <form>
        <div class="flexline">
            <label for="name">Name:</label>
            <input
                v-model.trim="newAuthor.name"
                required
                placeholder="Jane Austen"
                id="name"
            />
        </div>
        <div class="buttons">
            <button @click="router.back()">Cancel</button>
            <button @click="$emit('submit', newAuthor)">Store</button>
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
