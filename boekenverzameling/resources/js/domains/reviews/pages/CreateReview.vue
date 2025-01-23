<script setup lang="ts">
import { useRouter } from "vue-router";
import ReviewForm from "../components/ReviewForm.vue";
import { addReview } from "../store";
import { NewReview } from "../types";

const router = useRouter();

function submit(newReview: NewReview) {
    addReview(newReview);
    router.push({ name: "showBook", params: {id: newReview.book_id} });
}
</script>

<template>
    <ReviewForm @submit="submit" />
</template>
