import { computed, ref } from "vue";
import axios from "axios";
import type { Book, NewBook } from "./types";

// defineer een interface voor het spoofen methods in formdata voor laravel
interface SpoofMethod {
    _method: "PUT" | "PATCH" | "DELETE";
}

// Book-state
const books = ref<Book[]>([]);

// De functie die de aanvraag met Axios naar de backend stuurt
export const fetchBooks = async () => {
    const { data } = await axios.get<Book[]>("/api/books");
    if (!data) return;
    books.value = data;
};

export const addBook = async (book: NewBook) => {
    const { data } = await axios.postForm<Book>("/api/books", book);
    if (!data) return;
    books.value.push(data);
};

export const updateBookByID = async (id: string, book: NewBook) => {
    const payload: NewBook & SpoofMethod = { _method: "PATCH", ...book };
    const { data } = await axios.postForm<Book>(`/api/books/${id}`, payload);
    if (!data) return;
    const index = books.value.findIndex((book) => book.id == id);
    if (index >= 0) {
        books.value.splice(index, 1, data);
    }
};

export const removeBook = async (id: string) => {
    const { status } = await axios.delete(`/api/books/${id}`);
    if (status != 204) return;
    books.value = books.value.filter((book) => book.id != id);
};

export const getAllBooks = computed(() => books.value);
export const getBookByID = (id: string) =>
    computed(() => books.value.find((book) => book.id == id));
