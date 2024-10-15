<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use app\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Article>
 */
class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::inRandomOrder()->first()->id,
            'title' => $this->faker->sentence,
            'content' => $this->faker->paragraphs(3, true),
            'image_path' => null,
        ];
    }

    public function withImage(string $image_path): Factory {
        return $this->state(function (array $attributes) use ($image_path) {
            return [
                'image_path' => $image_path,
            ];
        });
    }
}
