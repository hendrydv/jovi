<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Customer>
 */
class CustomerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => fake()->company(),
            'contract_start_date' => fake()->dateTimeBetween('-1 year', 'now'),
            'contract_end_date' => fake()->dateTimeBetween('now', '+1 year'),
            'active' => fake()->boolean(),
            'preferred_month' => fake()->monthName(),
            'notes' => fake()->paragraph(),
        ];
    }
}
