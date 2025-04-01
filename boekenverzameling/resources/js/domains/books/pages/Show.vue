<script setup lang="ts">
import { useRoute, useRouter } from "vue-router";
import { fetchBooks, getBookByID } from "../store";
import { fetchReviewsByBookId, getReviews } from "../../reviews/store";
import { getAuthorByID } from "../../authors/store";
import ReviewList from "../../reviews/components/ReviewList.vue";

const router = useRouter();
const route = useRoute();

// TODO: "bookId" is nog iets duidelijker
// TODO: (vraag) is onderstaande controle noodzakelijk? (route param lijkt altijd string)
// antwoord: volgens de type van params.id kan het ook een array zijn, vandaar de check in
// de vorige versie
const bookId = route.params.id.toString();
const book = getBookByID(bookId);
const reviews = getReviews(bookId);

// TODO: pagina werkt niet bij harde page reload
// TODO: voorstel: hernoemen naar getReviewsByBookId?
// antwoord: fixed, done
const fetch = async () => {
    await fetchBooks();
    await fetchReviewsByBookId(bookId);
};
fetch();
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
