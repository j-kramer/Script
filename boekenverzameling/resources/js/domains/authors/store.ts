import { computed, ref } from "vue";
import axios from "axios";
import type { Author, NewAuthor } from "./types";

// defineer een interface voor het spoofen methods in formdata voor laravel
interface SpoofMethod {
    _method: "PUT" | "PATCH" | "DELETE";
}

// Author-state
const authors = ref<Author[]>([]);

// De functie die de aanvraag met Axios naar de backend stuurt
export const fetchAuthors = async () => {
    const { data } = await axios.get<Author[]>("/api/authors");
    if (!data) return;
    authors.value = data;
};

export const addAuthor = async (author: NewAuthor) => {
    const { data } = await axios.postForm<Author>("/api/authors", author);
    if (!data) return;
    authors.value.push(data);
};

export const updateAuthorByID = async (id: string, author: NewAuthor) => {
    const payload: NewAuthor & SpoofMethod = { _method: "PATCH", ...author };
    const { data } = await axios.postForm<Author>(
        `/api/authors/${id}`,
        payload
    );
    if (!data) return;
    const index = authors.value.findIndex((author) => author.id == id);
    if (index >= 0) {
        authors.value.splice(index, 1, data);
    }
};

export const removeAuthor = async (id: string) => {
    const { status } = await axios.delete(`/api/authors/${id}`);
    if (status != 204) return;
    authors.value = authors.value.filter((author) => author.id != id);
};

export const getAllAuthors = computed(() => authors.value);
export const getAuthorByID = (id: string) =>
    computed(() => authors.value.find((author) => author.id == id));
