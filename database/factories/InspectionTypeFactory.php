<?php

namespace Database\Factories;

use App\Models\Customer;
use App\Models\Inspection;
use App\Models\InspectionType;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<InspectionType>
 */
class InspectionTypeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->word,
        ];
    }
}
