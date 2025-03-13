import type {Category} from './types';

import {createOverviewRoute} from 'services/router/factory';
import {storeModuleFactory} from 'services/store';
import {setTranslation} from 'services/translation';

import OverviewPage from './pages/CategoryOverview.vue';

export const CATEGORY_DOMAIN_NAME = 'categories';

setTranslation(CATEGORY_DOMAIN_NAME, {
    singular: 'categorie',
    plural: 'categorieen',
});

export const categoryStore = storeModuleFactory<Category>(CATEGORY_DOMAIN_NAME);

export const categoryRoutes = [createOverviewRoute(CATEGORY_DOMAIN_NAME, OverviewPage)];
