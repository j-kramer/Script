import { createRouter, createWebHistory } from "vue-router";
import bookRoutes from "./domains/books/routes";

const routes = [...bookRoutes];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;
