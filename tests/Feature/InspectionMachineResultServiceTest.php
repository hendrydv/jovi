<?php

use App\Filament\Services\InspectionMachineResultService;
use App\Models\Customer;
use App\Models\Department;
use App\Models\Inspection;
use App\Models\InspectionList;
use App\Models\InspectionMachineResult;
use App\Models\Location;
use App\Models\Machine;
use App\Models\Question;
use App\Models\Space;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class InspectionMachineResultServiceTest extends TestCase
{
    use DatabaseTransactions;

    public function testCreateMachineResultsWithInspection()
    {
        $customer = Customer::factory()->create();
        $inspection = Inspection::factory()->for($customer)->create();
        $locations = Location::factory()->for($customer)->count(2)->create();

        foreach ($locations as $location) {
            $departments = Department::factory()->for($location)->count(2)->create();
            foreach ($departments as $department) {
                $spaces = Space::factory()->for($department)->count(2)->create();
                foreach ($spaces as $space) {
                    $inspectionList = InspectionList::factory()->create();
                    $questions = Question::factory()->count(2)->create();
                    $inspectionList->questions()->saveMany($questions);
                    $machines = Machine::factory()->for($inspectionList)->count(2)->create();
                    foreach ($machines as $idx => $machine) {
                        $space->machines()->attach($machine, [
                            'inventory_number' => $idx + 1,
                        ]);
                    }
                }
            }
        }

        InspectionMachineResultService::createResultsWithInspection($inspection);

        $inspectionMachineResults = InspectionMachineResult::all();

        $this->assertNotEmpty($inspectionMachineResults);

        $manyResults = 2 * 2 * 2 * 2 * 2;

        $this->assertEquals($manyResults, $inspectionMachineResults->count());
    }

    public function testCreateTypeResultsWithInspection()
    {
        $customer = Customer::factory()->create();
        $inspection = Inspection::factory()->for($customer)->create();
        $locations = Location::factory()->for($customer)->count(2)->create();

        $inspectionList = InspectionList::factory()->create();
        $inspectionQuestions = Question::factory()->count(2)->create();
        $inspectionList->questions()->saveMany($inspectionQuestions);

        $inspection->inspectionType->inspectionList()->associate($inspectionList);

        foreach ($locations as $location) {
            $departments = Department::factory()->for($location)->count(2)->create();
            foreach ($departments as $department) {
                $spaces = Space::factory()->for($department)->count(2)->create();
                foreach ($spaces as $space) {
                    $inspectionList = InspectionList::factory()->create();
                    $questions = Question::factory()->count(2)->create();
                    $inspectionList->questions()->saveMany($questions);
                    $machines = Machine::factory()->for($inspectionList)->count(2)->create();
                    foreach ($machines as $idx => $machine) {
                        $space->machines()->attach($machine, [
                            'inventory_number' => $idx + 1,
                        ]);
                    }
                }
            }
        }

        InspectionMachineResultService::createResultsWithInspection($inspection);

        $inspectionMachineResults = InspectionMachineResult::all();

        $this->assertNotEmpty($inspectionMachineResults);

        $manyResults = 2 * 2 * 2 * 2 * 2;

        $this->assertEquals($manyResults, $inspectionMachineResults->count());

        $questionIds = $inspectionQuestions->pluck('id')->toArray();

        foreach ($inspectionMachineResults as $inspectionMachineResult) {
            $this->assertTrue(in_array($inspectionMachineResult->question->id, $questionIds));
        }
    }
}
