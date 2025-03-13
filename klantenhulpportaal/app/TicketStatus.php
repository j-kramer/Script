<?php

namespace App;

enum TicketStatus: string
{
    case PENDING = 'Pending';
    case INPROGRESS = 'In progress';
    case RESOLVED = 'Resolved';
}
