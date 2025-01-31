import type {RouteRecordRedirect} from 'vue-router';

import {userRoutes} from 'domains/users';

import {addRoutes} from './services/router';

const home: RouteRecordRedirect = {
    path: '/',
    name: 'home',
    redirect: {name: 'users.overview'},
};

const routes = [home, ...userRoutes];

addRoutes(routes);
