import type {RouteComponent, RouteRecordSingleView} from 'vue-router';

import {getPluralTranslation, getSingularTranslation} from 'services/translation';

export const CREATE_PAGE_NAME = '.create';
export const EDIT_PAGE_NAME = '.edit';
export const OVERVIEW_PAGE_NAME = '.overview';
export const SHOW_PAGE_NAME = '.show';

const defaultMeta = {requiresAuth: true};

export const createShowRoute = (
    module: string,
    component: RouteComponent,
    meta = defaultMeta,
): RouteRecordSingleView => ({
    path: `/${getSingularTranslation(module)}/:id`,
    name: module + SHOW_PAGE_NAME,
    component,
    meta,
});

export const createCreateRoute = (
    module: string,
    component: RouteComponent,
    meta = defaultMeta,
): RouteRecordSingleView => ({
    path: `/${getSingularTranslation(module)}/toevoegen`,
    name: module + CREATE_PAGE_NAME,
    component,
    meta,
});

export const createOverviewRoute = (
    module: string,
    component: RouteComponent,
    meta = defaultMeta,
): RouteRecordSingleView => ({
    path: `/${getPluralTranslation(module)}`,
    name: module + OVERVIEW_PAGE_NAME,
    component,
    meta,
});

export const createEditRoute = (
    module: string,
    component: RouteComponent,
    meta = defaultMeta,
): RouteRecordSingleView => ({
    path: `/${getSingularTranslation(module)}/:id/aanpassen`,
    name: module + EDIT_PAGE_NAME,
    component,
    meta,
});
