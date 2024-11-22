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
        User::factory(2)->sequence([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ], [
            'name' => 'Test User 2',
            'email' => 'test2@example.com',
        ])->create();
        User::factory(10)->create();

        $this->call([
            CategorySeeder::class,
            ArticleSeeder::class,
            CommentSeeder::class,
        ]);
    }
}
