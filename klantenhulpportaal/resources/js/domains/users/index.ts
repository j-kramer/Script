import type {User} from './types';

import {createOverviewRoute} from 'services/router/factory';
import {storeModuleFactory} from 'services/store';
import {setTranslation} from 'services/translation';

import OverviewPage from './pages/UserOverview.vue';

export const USER_DOMAIN_NAME = 'users';

setTranslation(USER_DOMAIN_NAME, {
    singular: 'gebruiker',
    plural: 'gebruikers',
});

export const userStore = storeModuleFactory<User>(USER_DOMAIN_NAME);

export const userRoutes = [createOverviewRoute(USER_DOMAIN_NAME, OverviewPage)];
