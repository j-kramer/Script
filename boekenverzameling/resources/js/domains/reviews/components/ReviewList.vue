<script setup lang="ts">
import ReviewCard from "./ReviewCard.vue";
import type { Review } from "../types";

const props = defineProps<{
    reviews: Review[];
}>();
</script>

<template>
    <ul v-if="reviews.length">
        <li v-for="(review, index) in reviews" :key="index">
            <ReviewCard :review="review" />
        </li>
    </ul>
</template>
