import { createRouter, createWebHistory } from "vue-router";
import bookRoutes from "./domains/books/routes";
import authorRoutes from "./domains/authors/routes";
import reviewRoutes from "./domains/reviews/routes";

const routes = [
    {
        path: "/",
        redirect: "/books",
    },
    ...bookRoutes,
    ...authorRoutes,
    ...reviewRoutes,
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;
