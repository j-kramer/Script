import type {RouteRecordRaw} from 'vue-router';

import {ticketRoutes} from 'domains/tickets';
import {userRoutes} from 'domains/users';
import {setAuthRoutes} from 'services/auth';

import ForgotPasswordPage from './pages/auth/ForgotPasswordPage.vue';
import Login from './pages/auth/LoginPage.vue';
import RegisterPage from './pages/auth/RegisterPage.vue';
import ResetPasswordPage from './pages/auth/ResetPasswordPage.vue';
import Home from './pages/home.vue';
import {addRoutes} from './services/router';

const home: RouteRecordRaw = {
    path: '/',
    name: 'home',
    component: Home,
    meta: {requiresAuth: true, requiresAdmin: false, ignoreFrom: true},
};

const routes = [home, ...ticketRoutes, ...userRoutes];

addRoutes(routes);
setAuthRoutes(Login, ForgotPasswordPage, ResetPasswordPage, RegisterPage);
