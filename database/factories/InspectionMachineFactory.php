<?php

namespace Database\Factories;

use App\Models\Inspection;
use App\Models\InspectionMachine;
use App\Models\InspectionMachineResult;
use App\Models\Question;
use App\Models\SpaceMachine;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<InspectionMachineResult>
 */
class InspectionMachineFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'space_machine_id' => SpaceMachine::factory(),
            'inspection_id' => Inspection::factory(),
        ];
    }
}
