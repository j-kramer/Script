<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(3)->sequence(
            [
                'first_name' => 'Test',
                'last_name' => 'User',
                'email' => 'test@example.com',
            ], [
                'first_name' => 'Admin',
                'last_name' => 'User',
                'email' => 'admin@example.com',
                'is_admin' => true,
            ], [
                'first_name' => 'Admin2',
                'last_name' => 'User',
                'email' => 'admin2@example.com',
                'is_admin' => true,
            ]
        )->create();

        User::factory(10)->create();

        $this->call([
            CategorySeeder::class,
            TicketSeeder::class,
        ]);
    }
}
