import { createRouter, createWebHistory } from 'vue-router'
import Overview from '@/views/Overview.vue'
import Add from '@/views/Add.vue'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'overview',
      component: Overview,
    },
    {
      path: '/add',
      name: 'addItem',
      component: Add,
    },
  ],
})

export default router
