<script setup lang="ts">
import { useRoute, useRouter } from "vue-router";
import { getBookByID } from "../store";
import { fetchReviews, getReviews } from "../../reviews/store";
import { getAuthorByID } from "../../authors/store";
import ReviewList from "../../reviews/components/ReviewList.vue";

const router = useRouter();
const route = useRoute();

// TODO: "bookId" is nog iets duidelijker
let id: string;
// TODO: (vraag) is onderstaande controle noodzakelijk? (route param lijkt altijd string)
if (typeof route.params.id == "string") {
    id = route.params.id;
} else {
    id = route.params.id[0];
}
const book = getBookByID(id);

// TODO: pagina werkt niet bij harde page reload
fetchReviews(id);
// TODO: voorstel: hernoemen naar getReviewsByBookId?
const reviews = getReviews(id);
</script>

<template>
    <div v-if="book">
        <article>
            <div>
                <img :src="'/' + book.cover_path" alt="book cover" />
            </div>
            <div>
                {{ book.title }}
                <br />
                <small
                    >By {{ getAuthorByID(book.author_id).value?.name }}</small
                >
            </div>
        </article>
        <div>
            <button
                @click="
                    router.push({ name: 'createReview', params: { id: id } })
                "
            >
                Schrijf een review
            </button>
            <h1>Reviews:</h1>
            <ReviewList v-if="reviews.length" :reviews="reviews" />
            <p v-else>Er zijn geen reviews</p>
        </div>
    </div>
</template>
