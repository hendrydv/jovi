<?php

namespace Database\Factories;

use App\Models\Inspection;
use App\Models\InspectionMachineResult;
use App\Models\Question;
use App\Models\SpaceMachine;
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
    public function definition(): array
    {
        return [
            'inspection_id' => Inspection::factory(),
            'space_machine_id' => SpaceMachine::factory(),
            'question_id' => Question::factory(),
            'result' => $this->faker->randomElement(InspectionMachineResult::RESULT_TYPES),
        ];
    }
}
