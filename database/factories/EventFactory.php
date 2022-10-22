<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Event>
 */
class EventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'owner_id' => '01gf2rr0fjvfsa8c1jznvvnznd',
            'name' => fake()->words(3, true),
            'date' => fake()->date(),
            'begin_time' => fake()->time(),
            'location' => fake()->streetAddress()
        ];
    }
}
