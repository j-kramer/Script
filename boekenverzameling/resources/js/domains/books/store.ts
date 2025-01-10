import { computed, ref } from "vue";
import axios from "axios";
import type { Book } from "./types";

// Book-state
const books = ref<Book[]>([]);

// De functie die de aanvraag met Axios naar de backend stuurt
export const fetchBooks = async () => {
    const { data } = await axios.get("api/books");
    if (!data) return;
    books.value = data;
};

export const getAllBooks = computed(() => books.value);
