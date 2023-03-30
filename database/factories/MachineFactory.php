<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Kind;
use App\Models\Brand;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Machine>
 */
class MachineFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'type' => $this->faker->word,
            'image' => $this->faker->imageUrl,
            'supplier' => $this->faker->word,
            'kind_id' => Kind::factory(),
            'brand_id' => Brand::factory(),
        ];
    }
}
