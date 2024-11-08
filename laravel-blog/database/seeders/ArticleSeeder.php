<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Article;
use App\Models\Category;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = Category::all();
        $categoryCount = Category::count();

        Article::factory(20)->sequence(
            ['image_path' => null],
            ['image_path' => 'y.svg'],
            )->create();

        Article::all()->each(function (Article $article) use (&$categories, $categoryCount) {
            $article->categories()->sync($categories->random(rand(0,$categoryCount)));
        });
    }
}
