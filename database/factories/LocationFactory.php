<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Customer;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Location>
 */
class LocationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'street' => fake()->streetName(),
            'house_number' => fake()->buildingNumber(),
            'zip_code' => fake()->postcode(),
            'city' => fake()->city(),
            'customer_id' => Customer::factory(),
        ];
    }
}
