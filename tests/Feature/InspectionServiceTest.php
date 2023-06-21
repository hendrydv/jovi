<?php

namespace Tests\Feature;

use App\Filament\Services\InspectionService;
use App\Models\Inspection;
use App\Models\InspectionMachineResult;
use App\Models\SpaceMachine;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class InspectionServiceTest extends TestCase
{
    use DatabaseTransactions;

    public function testGetInspectionStateNotStarted()
    {
        $inspection = Inspection::factory()->create();
        $spaceMachine = SpaceMachine::factory()->create();

        InspectionMachineResult::factory()->count(3)->create([
            'inspection_id' => $inspection->id,
            'space_machine_id' => $spaceMachine->id,
            'result' => null,
        ]);

        $this->assertEquals(
            InspectionService::NOT_STARTED,
            InspectionService::getInspectionState($inspection, $spaceMachine)
        );
    }

    public function testGetInspectionStateStarted()
    {
        $inspection = Inspection::factory()->create();
        $spaceMachine = SpaceMachine::factory()->create();

        InspectionMachineResult::factory()->count(3)->create([
            'inspection_id' => $inspection->id,
            'space_machine_id' => $spaceMachine->id,
            'result' => array_rand(InspectionMachineResult::RESULT_TYPES),
        ]);

        InspectionMachineResult::factory()->count(3)->create([
            'inspection_id' => $inspection->id,
            'space_machine_id' => $spaceMachine->id,
            'result' => null,
        ]);

        $this->assertEquals(
            InspectionService::STARTED,
            InspectionService::getInspectionState($inspection, $spaceMachine)
        );
    }

    public function testGetInspectionStateFinished()
    {
        $inspection = Inspection::factory()->create();
        $spaceMachine = SpaceMachine::factory()->create();

        InspectionMachineResult::factory()->count(3)->create([
            'inspection_id' => $inspection->id,
            'space_machine_id' => $spaceMachine->id,
            'result' => array_rand(InspectionMachineResult::RESULT_TYPES),
        ]);

        $this->assertEquals(
            InspectionService::FINISHED,
            InspectionService::getInspectionState($inspection, $spaceMachine)
        );
    }
}
