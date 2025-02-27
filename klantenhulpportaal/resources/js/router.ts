import type {RouteRecordRedirect} from 'vue-router';

import {userRoutes} from 'domains/users';
import {setAuthRoutes} from 'services/auth';

import ForgotPasswordPage from './pages/auth/ForgotPasswordPage.vue';
import Login from './pages/auth/LoginPage.vue';
import RegisterPage from './pages/auth/RegisterPage.vue';
import ResetPasswordPage from './pages/auth/ResetPasswordPage.vue';
import {addRoutes} from './services/router';

const home: RouteRecordRedirect = {
    path: '/',
    name: 'home',
    redirect: {name: 'users.overview'},
};

const routes = [home, ...userRoutes];

addRoutes(routes);
setAuthRoutes(Login, ForgotPasswordPage, ResetPasswordPage, RegisterPage);
