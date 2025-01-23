<script setup lang="ts">
import type { Review } from "../types";
import { useRouter } from "vue-router";
import IconEdit from "../../../icons/IconEdit.vue";
import IconDelete from "../../../icons/IconDelete.vue";
import { removeReview } from "../store";

const props = defineProps<{
    review: Review;
}>();

const router = useRouter();
</script>

<template>
    <article class="card">
        <div>
            {{ review.comment }}
        </div>
        <div>
            <button
                @click="
                    router.push({ name: 'editReview', params: { id: review.id } })
                "
            >
                <IconEdit />
            </button>
            <button @click="removeReview(review.id)"><IconDelete /></button>
        </div>
    </article>
</template>

<style lang="css" scoped>
.card {
    display: flex;
    flex-direction: row;
}
</style>
