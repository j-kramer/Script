<script setup lang="ts">
import type { Author } from "../types";
import IconEdit from "../../../icons/IconEdit.vue";
import IconDelete from "../../../icons/IconDelete.vue";
import { removeAuthor } from "../store";
import { useRouter } from "vue-router";

const props = defineProps<{
    authors: Author[];
}>();

const router = useRouter();
</script>

<template>
    <ul v-if="authors.length">
        <li v-for="(author, index) in authors" :key="index">
            {{ author.name }}
            <button
                @click="
                    router.push({
                        name: 'editAuthor',
                        params: { id: author.id },
                    })
                "
            >
                <IconEdit />
            </button>
            <button @click="removeAuthor(author.id)"><IconDelete /></button>
        </li>
    </ul>
    <p v-else>Er zijn geen auteurs bekend</p>
</template>
