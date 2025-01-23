<script setup lang="ts">
import { useRouter, useRoute } from "vue-router";
import type { Review, NewReview } from "../types";

const props = defineProps<{
    review?: Review;
}>();
const emit = defineEmits<{ submit: [review: NewReview] }>();

const router = useRouter();

let newReview: NewReview;
if (props.review) {
    newReview = Object.assign({}, props.review) as NewReview;
} else {
    const route = useRoute();

    let id: string;
    if (typeof route.params.id == "string") {
        id = route.params.id;
    } else {
        id = route.params.id[0];
    }

    newReview = {
        book_id: id,
        comment: "",
    };
}
</script>

<template>
    <form>
        <div class="flexline">
            <label for="comment">Comment:</label>
            <textarea
                v-model.trim="newReview.comment"
                required
                placeholder="wat vind je van het boek?"
                id="comment"
            ></textarea>
        </div>
        <div class="buttons">
            <button @click="router.back()">Cancel</button>
            <button @click="$emit('submit', newReview)">Store</button>
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
