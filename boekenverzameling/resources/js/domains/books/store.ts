import { ref } from "vue";
import axios from "axios";

// Book-state
const books = ref([]);

// De functie die de aanvraag met Axios naar de backend stuurt
const fetchBooks = async () => {
    const {
        data: { data: data },
    } = await axios.get("api/books");
    if (!data) return;
    console.log(data);
    books.value = data;
};
fetchBooks();

export const getAllBooks = () => books.value;
