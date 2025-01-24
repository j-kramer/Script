import { createRouter, createWebHistory, RouteRecordRaw } from "vue-router";
import { Component } from "vue";

const router = createRouter({
    history: createWebHistory(),
    routes: [],
});

export default router;

export const goToRoute = (name: string, id?: number) => {
    const route: { name: string; params?: { id: number } } = { name };

    // Voeg de 'id' toe aan de 'params' als deze aanwezig is
    if (id) {
        route.params = { id };
    }

    // Navigeer naar de opgegeven route
    router.push(route);
};

export const createRoute = (
    name: string,
    path: string,
    component: Component,
) => {
    return {
        name,
        path,
        component,
    };
};

export const addRoutes = (routes: RouteRecordRaw[]) => {
    for (const route of routes) {
        router.addRoute(route);
    }
};
