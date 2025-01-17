import { createRouter, createWebHistory } from "vue-router";
import bookRoutes from "./domains/books/routes";
import authorRoutes from "./domains/authors/routes";

const routes = [...bookRoutes, ...authorRoutes];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;
