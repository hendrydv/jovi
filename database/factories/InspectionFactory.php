<?php

namespace Database\Factories;

use App\Models\Inspection;
use App\Models\Machine;
use App\Models\Space;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Inspection>
 */
class InspectionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'space_id' => Space::factory(),
            'machine_id' => Machine::factory(),
            'user_id' => User::factory(),
            'date' => $this->faker->dateTimeBetween('now', '+1 week'),
            'notes' => $this->faker->text(),
        ];
    }
}
