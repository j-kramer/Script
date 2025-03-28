<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Ticket;
use Illuminate\Database\Seeder;

class TicketSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = Category::all();
        $categoryCount = Category::Count();

        $tickets = Ticket::Factory(20)->create();

        $tickets->merge(Ticket::Factory(5)->inProgress()->create());
        $tickets->merge(Ticket::Factory(5)->inProgress()->assigned()->create());
        $tickets->merge(Ticket::Factory(5)->resolved()->assigned()->create());

        $tickets->each(function (Ticket $ticket) use (&$categories, &$categoryCount) {
            $ticket->categories()->sync($categories->random(rand(0, $categoryCount)));
        });
    }
}
