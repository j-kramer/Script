import type {Ticket} from './types';

import {createOverviewRoute, createShowRoute} from 'services/router/factory';
import {storeModuleFactory} from 'services/store';
import {setTranslation} from 'services/translation';

import OverviewPage from './pages/TicketOverview.vue';
import TicketView from './pages/TicketView.vue';
import {Status} from './types';

export const TICKET_DOMAIN_NAME = 'tickets';

setTranslation(TICKET_DOMAIN_NAME, {
    singular: 'ticket',
    plural: 'tickets',
});

export const ticketStore = storeModuleFactory<Ticket>(TICKET_DOMAIN_NAME);

export const ticketRoutes = [
    createOverviewRoute(TICKET_DOMAIN_NAME, OverviewPage),
    createShowRoute(TICKET_DOMAIN_NAME, TicketView),
];

export const fmtStatus = function (status: Status): string {
    switch (status) {
        case Status.pending:
            return 'In afwachting';
        case Status.inProgress:
            return 'In behandeling';
        case Status.resolved:
            return 'Afgehandeld';
    }
};
