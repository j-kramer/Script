import type {Ticket} from './types';

import {createOverviewRoute} from 'services/router/factory';
import {storeModuleFactory} from 'services/store';
import {setTranslation} from 'services/translation';

import OverviewPage from './pages/TicketOverview.vue';
import {Status} from './types';

export const TICKET_DOMAIN_NAME = 'tickets';

setTranslation(TICKET_DOMAIN_NAME, {
    singular: 'ticket',
    plural: 'tickets',
});

export const ticketStore = storeModuleFactory<Ticket>(TICKET_DOMAIN_NAME);

export const ticketRoutes = [createOverviewRoute(TICKET_DOMAIN_NAME, OverviewPage)];

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
