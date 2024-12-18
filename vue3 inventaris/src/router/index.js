import { createRouter, createWebHistory } from 'vue-router'
import Overview from '@/views/Overview.vue'
import Add from '@/views/Add.vue'
import Edit from '@/views/Edit.vue'
import Order from '@/views/Order.vue'

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
    {
      path: '/edit/:id',
      name: 'editItem',
      component: Edit,
    },
    {
      path: '/order',
      name: 'order',
      component: Order,
    },
  ],
})

export default router
