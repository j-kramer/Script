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
        $datetime = $this->faker->dateTimeThisMonth();

        return [
            'user_id' => User::inRandomOrder()->first()->id,
            'title' => $this->faker->sentence,
            'content' => $this->faker->paragraphs(3, true),
            'image_path' => null,
            'is_premium_content' => $this->faker->boolean(),
            'sponsored_untill' => $this->faker->optional(0.1, $datetime)->dateTimeBetween('now', '+1 month'),
            'created_at' => $datetime,
            'updated_at' => $datetime,
        ];
    }
}
