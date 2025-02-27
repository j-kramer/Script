import './bootstrap';
import './router';

import {createApp} from 'vue';

import {checkIfLoggedIn} from 'services/auth';

import App from './App.vue';
import {useRouterInApp} from './services/router';

const app = createApp(App);
// before loading the route, check if the user is logged in from last time
try {
    await checkIfLoggedIn();
} catch {
    // ignore any errors, since it means the user is not logged in anyways
}
useRouterInApp(app);
app.mount('#app');
