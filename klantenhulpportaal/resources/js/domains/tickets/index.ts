import type {Ticket} from './types';

import {createOverviewRoute} from 'services/router/factory';
import {storeModuleFactory} from 'services/store';
import {setTranslation} from 'services/translation';

import OverviewPage from './pages/TicketOverview.vue';

export const TICKET_DOMAIN_NAME = 'tickets';

setTranslation(TICKET_DOMAIN_NAME, {
    singular: 'ticket',
    plural: 'tickets',
});

export const ticketStore = storeModuleFactory<Ticket>(TICKET_DOMAIN_NAME);

export const ticketRoutes = [createOverviewRoute(TICKET_DOMAIN_NAME, OverviewPage)];
