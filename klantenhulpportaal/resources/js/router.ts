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
    meta: {auth: true, canSeeWhenLoggedIn: true},
};

const routes = [home, ...userRoutes];

addRoutes(routes);
setAuthRoutes(Login, ForgotPasswordPage, ResetPasswordPage, RegisterPage);
