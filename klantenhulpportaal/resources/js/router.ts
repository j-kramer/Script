import { createRouter, createWebHistory } from "vue-router";
import userRouter from "./domains/users/router";

const routes = [
    {
        path: "/",
        name: "home",
        redirect: "/users",
    },
    ...userRouter,
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;
