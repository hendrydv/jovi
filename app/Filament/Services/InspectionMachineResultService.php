<?php

namespace App\Filament\Services;

use App\Models\Customer;
use App\Models\Inspection;
use App\Models\InspectionMachineResult;
use App\Models\InspectionType;
use App\Models\SpaceMachine;

class InspectionMachineResultService
{
    public static function createResultsWithInspection(Inspection $inspection): void
    {
        $locations = $inspection->customer->locations;
        $locations->each(function($location) use ($inspection){

            $departments = $location->departments;
            $departments->each(function($department) use ($inspection) {

                $spaces = $department->spaces;
                $spaces->each(function($space) use ($inspection) {

                    $machines = $space->machines;
                    $machines->each(function($machine) use ($inspection) {

                        $space_id = $machine->pivot->space_id;
                        $machine_id = $machine->id;
                        $inventory_number = $machine->pivot->inventory_number;

                        $space_machines = SpaceMachine::query()
                            ->where(['space_id' => $space_id, 'machine_id' => $machine_id, 'inventory_number' => $inventory_number])
                            ->get();

                        $space_machines->each(function($space_machine) use ($machine, $inspection)  {
                            $space_machine_id = $space_machine->id; // get space_machine id
                            $inspectionList = $machine->inspectionList;

                            if ($inspection->inspectionType?->inspectionList) {
                                $inspectionList = $inspection->inspectionType->inspectionList;
                            }

                            if ($inspectionList == null) {
                                return;
                            }

                            $questions = $inspectionList->questions;
                            $questions->each(function($question) use ($inspection, $space_machine_id) {
                                $question_id = $question->id; // get question id
                                InspectionMachineResult::create([
                                    'inspection_id' => $inspection->id,
                                    'space_machine_id' => $space_machine_id,
                                    'question_id' => $question_id,
                                    'result' => null,
                                ]);
                            });
                        });
                    });
                });
            });
        });
    }

    /**
     * @param InspectionMachineResult[] $inspectionMachineResults
     * @return string
     */
    public static function getStateFromInspectionMachineResults(array $inspectionMachineResults): string
    {
        if (empty(array_filter(array_column($inspectionMachineResults, 'result'), fn ($inspectionMachineResult) => $inspectionMachineResult !== null))) {
            return InspectionService::NOT_STARTED;
        }

        if (in_array(null, array_column($inspectionMachineResults, 'result'))) {
            return InspectionService::STARTED;
        }

        return InspectionService::FINISHED;
    }
}
