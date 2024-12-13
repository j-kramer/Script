import {createMemoryHistory, createRouter} from 'vue-router';
import Overview from '@/pages/Overview.vue';
import Create from '@/pages/Create.vue';
import Edit from '@/pages/Edit.vue';

const routes = [
    {path: '/', name: 'overview', component: Overview},
    {path: '/create', name: 'add', component: Create},
    {path: '/edit/:id', name: 'edit', component: Edit},
];

const router = createRouter({
    history: createMemoryHistory(),
    routes,
});

export default router;
