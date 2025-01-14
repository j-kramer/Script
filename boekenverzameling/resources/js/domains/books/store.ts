import { computed, ref } from "vue";
import axios from "axios";
import type { Book, NewBook} from "./types";

// Book-state
const books = ref<Book[]>([]);

// De functie die de aanvraag met Axios naar de backend stuurt
export const fetchBooks = async () => {
    const { data } = await axios.get<Book[]>("api/books");
    if (!data) return;
    books.value = data;
};

export const addBook = async (book: NewBook) => {
    const { data } = await axios.post<Book>("api/books", book, {
        headers: {
            "Content-Type": "multipart/form-data",
        },
    });
    if (!data) return;
    books.value.push(data);
};

export const getAllBooks = computed(() => books.value);
