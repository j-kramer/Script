import type {
    InvitedUser,
    LoggedInUser,
    LoginCredentials,
    RegisterData,
    ResetPasswordData,
    ResponseErrorMiddleware,
} from './types';
import type {Component} from 'vue';
import type {NavigationGuard} from 'vue-router';

import {computed, ref} from 'vue';

import {USER_DOMAIN_NAME} from 'domains/users';
import {getRequest, postRequest, registerResponseErrorMiddleware} from 'services/http';
import {addRoutes, createLocation, goToRoute, registerBeforeRouteMiddleware} from 'services/router';
import {clearStorage} from 'services/storage';
import {successToast} from 'services/toast';

export const LOGIN_ROUTE_NAME = 'Login';
export const FORGOT_PASSWORD_ROUTE_NAME = 'ForgotPassword';
export const RESET_PASSWORD_ROUTE_NAME = 'ResetPassword';
export const REGISTER_ROUTE_NAME = 'Register';

const apiLoginRoute = '/login';
const apiLogoutRoute = '/logout';
const apiLoggedInCheckRoute = '/me';
const apiSendResetPasswordEmailRoute = '/send-reset-password-email';
const apiResetpasswordRoute = '/reset-password';

const goToDefaultLoggedInPage = () => goToRoute('home');

export const goToLoginPage = (from?: string) => goToRoute(LOGIN_ROUTE_NAME, undefined, {from});

const loggedInUser = ref<LoggedInUser | undefined>();

export const getLoggedInUser = () => {
    if (!loggedInUser.value) throw Error("Can't call getLoggedInUser when not logged in");

    return loggedInUser.value;
};

export const isAdmin = computed(() => loggedInUser.value?.is_admin);

export const isLoggedIn = computed(() => loggedInUser.value !== undefined);

const HTTP_FORBIDDEN = 403;
const HTTP_UNAUTHORIZED = 401;

const responseErrorMiddleware: ResponseErrorMiddleware = ({response}) => {
    if (!response) return;
    const {status} = response;
    if (status === HTTP_FORBIDDEN) goToDefaultLoggedInPage();
    else if (status === HTTP_UNAUTHORIZED && isLoggedIn.value) {
        // only need to logout of the app, because on the backend the user is already logged out
        logoutOfApp();
    }
};

registerResponseErrorMiddleware(responseErrorMiddleware);

const beforeMiddleware: NavigationGuard = to => {
    if (!isLoggedIn.value && to.meta.requiresAuth)
        return createLocation(LOGIN_ROUTE_NAME, undefined, {from: to.fullPath});

    /*
     * we have to give return a location that ignores the from query, otherwise
     * we might end up looping between redirecting to the from query and this location
     */
    if (!isAdmin.value && to.meta.requiresAdmin) return createLocation('home');

    return true;
};

registerBeforeRouteMiddleware(beforeMiddleware);

const setLoggedInAndUser = (user: LoggedInUser) => {
    loggedInUser.value = user;
};

const logoutOfApp = () => {
    clearStorage();
    window.location.reload();
};

export const login = async (credentials: LoginCredentials) => {
    const response = await postRequest(apiLoginRoute, credentials);

    setLoggedInAndUser(response.data.user);
    goToDefaultLoggedInPage();

    return response;
};

export const guestLogin = async () => {
    const response = await getRequest('guestLogin');

    setLoggedInAndUser(response.data.user);
    goToDefaultLoggedInPage();

    return response;
};

export const logout = async () => {
    const response = await postRequest(apiLogoutRoute, {});

    logoutOfApp();

    return response;
};

export const checkIfLoggedIn = async () => {
    const {data} = await getRequest(apiLoggedInCheckRoute);

    setLoggedInAndUser(data.user);
};

export const sendResetPasswordEmail = async (email: string) => {
    const response = await postRequest(apiSendResetPasswordEmailRoute, {email});

    successToast('Er is een email verstuurd om uw wachtwoord te resetten');

    goToLoginPage();

    return response;
};

export const resetPassword = async (data: ResetPasswordData) => {
    const response = await postRequest(apiResetpasswordRoute, data);

    successToast('Je wachtwoord is succesvol aangepast. Login om verder te gaan.');

    goToLoginPage();

    return response;
};

export const register = async (data: RegisterData) => {
    const response = await postRequest('register', data);

    successToast('Je bent succesvol geregistreerd');

    goToLoginPage();

    return response;
};

export const registerWithToken = async (data: RegisterData) => {
    const response = await postRequest('register-token', data);

    successToast('Je bent succesvol geregistreerd');

    goToLoginPage();

    return response;
};

export const getUserByToken = async (token: string): Promise<InvitedUser> => {
    const {data} = await getRequest(`${USER_DOMAIN_NAME}/token/${token}`);

    return data;
};

const authMeta = {requiresAuth: false, requiresAdmin: false, ignoreFrom: true};

export const setAuthRoutes = (
    loginPage: Component,
    forgotPasswordPage: Component,
    resetPasswordPage: Component,
    registerPage: Component,
) => {
    addRoutes([
        loginRoute(loginPage),
        forgotPasswordRoute(forgotPasswordPage),
        resetPasswordRoute(resetPasswordPage),
        registerRoute(registerPage),
    ]);
};

const loginRoute = (loginPage: Component) => ({
    path: '/inloggen',
    name: LOGIN_ROUTE_NAME,
    component: loginPage,
    meta: authMeta,
});

const forgotPasswordRoute = (forgotPasswordPage: Component) => ({
    path: '/wachtwoord-vergeten',
    name: FORGOT_PASSWORD_ROUTE_NAME,
    component: forgotPasswordPage,
    meta: authMeta,
});

const resetPasswordRoute = (resetPasswordPage: Component) => ({
    path: '/wachtwoord-resetten/:token',
    name: RESET_PASSWORD_ROUTE_NAME,
    component: resetPasswordPage,
    meta: authMeta,
});

const registerRoute = (registerPage: Component) => ({
    path: '/registreren',
    name: REGISTER_ROUTE_NAME,
    component: registerPage,
    meta: authMeta,
});
