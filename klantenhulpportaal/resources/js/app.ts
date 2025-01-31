import './bootstrap';
import './router';

import {createApp} from 'vue';

import App from './App.vue';
import {useRouterInApp} from './services/router';

const app = createApp(App);
useRouterInApp(app);
app.mount('#app');
