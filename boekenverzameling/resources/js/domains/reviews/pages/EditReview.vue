<script setup lang="ts">
import { useRouter, useRoute } from "vue-router";
import ReviewForm from "../components/ReviewForm.vue";
import { getReviewByID, updateReviewByID } from "../store";
import { NewReview } from "../types";

const router = useRouter();
const route = useRoute();

let id: string;
if (typeof route.params.id == "string") {
    id = route.params.id;
} else {
    id = route.params.id[0];
}

const review = getReviewByID(id);

function submit(newReview: NewReview) {
    updateReviewByID(id, newReview);
    router.push({ name: "showBook", params: {id: newReview.book_id} });
}
</script>

<template>
    <ReviewForm :review="review" @submit="submit" />
</template>
