import { createRouter, createWebHistory } from 'vue-router'
import bookRouter from './domains/books/router'

const routes = [
    ...bookRouter,
]

const router = createRouter({
    history: createWebHistory(),
    routes,
})

export default router
