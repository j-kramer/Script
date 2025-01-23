import { computed, ref } from "vue";
import axios from "axios";
import type { Review, NewReview } from "./types";

// defineer een interface voor het spoofen methods in formdata voor laravel
interface SpoofMethod {
    _method: "PUT" | "PATCH" | "DELETE";
}

// Reviews-state
const reviews = ref<Review[]>([]);

// De functie die de aanvraag met Axios naar de backend stuurt
export const fetchReviews = async (book_id: string) => {
    const { data } = await axios.get<Review[]>(`/api/books/${book_id}/reviews`);
    if (!data) return;
    // probably should save reviews for more than one book at a time
    reviews.value = data;
};

export const addReview = async (review: NewReview) => {
    const { data } = await axios.postForm<Review>(`/api/books/${review.book_id}/reviews`, review);
    if (!data) return;
    reviews.value.push(data);
};

export const updateReviewByID = async (id: string, review: NewReview) => {
    const tmp: NewReview & SpoofMethod = { _method: "PATCH", ...review };
    const { data } = await axios.postForm<Review>(`/api/reviews/${id}`, tmp);
    if (!data) return;
    const index = reviews.value.findIndex((review) => review.id == id);
    if (index >= 0) {
        reviews.value.splice(index, 1, data);
    }
};

export const removeReview = async (id: string) => {
    const { status } = await axios.delete(`/api/reviews/${id}`);
    if (status != 204) return;
    reviews.value = reviews.value.filter((review) => review.id != id);
};

export const getReviews = (book_id: string) =>
    computed(() => reviews.value.filter((review) => review.book_id == book_id));
export const getReviewByID = (review_id: string) =>
    computed(() => reviews.value.find((review) => review.id == review_id));
