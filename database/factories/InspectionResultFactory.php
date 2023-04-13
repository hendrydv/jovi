<?php

namespace Database\Factories;

use App\Models\Inspection;
use App\Models\InspectionResult;
use App\Models\Question;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<InspectionResult>
 */
class InspectionResultFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'inspection_id' => Inspection::factory(),
            'question_id' => Question::factory(),
            'result' => $this->faker->randomElement(InspectionResult::RESULT_TYPES),
        ];
    }
}
