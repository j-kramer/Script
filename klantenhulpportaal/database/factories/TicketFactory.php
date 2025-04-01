<?php

namespace Database\Factories;

use App\Models\User;
use App\TicketStatus;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Ticket>
 */
class TicketFactory extends Factory
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
            'title' => $this->faker->sentence(),
            'content' => $this->faker->paragraphs(3, true),
            'creator_id' => User::inRandomOrder()->first()->id,
            'created_at' => $datetime,
            'updated_at' => $datetime,
        ];
    }

    public function inProgress(): static
    {
        return $this->state(function (array $attributes) {
            return [
                'status' => TicketStatus::INPROGRESS,
            ];
        });
    }

    public function resolved(): static
    {
        return $this->state(function (array $attributes) {
            return [
                'status' => TicketStatus::RESOLVED,
            ];
        });
    }

    public function assigned(): static
    {
        return $this->state(function (array $attributes) {
            return [
                'assignee_id' => User::where('is_admin', true)->inRandomOrder()->first()->id,
            ];
        });
    }
}
