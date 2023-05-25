<?php

namespace Database\Factories;

use App\Models\Inspection;
use App\Models\InspectionMachine;
use App\Models\InspectionMachineResult;
use App\Models\Question;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<InspectionMachineResult>
 */
class InspectionMachineResultFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'inspection_machine_id' => InspectionMachine::factory(),
            'question_id' => Question::factory(),
            'result' => $this->faker->randomElement(InspectionMachineResult::RESULT_TYPES),
        ];
    }
}
