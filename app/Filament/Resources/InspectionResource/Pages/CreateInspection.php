<?php

namespace App\Filament\Resources\InspectionResource\Pages;

use App\Filament\Resources\InspectionResource;
use App\Models\Inspection;
use App\Models\InspectionMachineResult;
use App\Models\SpaceMachine;
use Filament\Resources\Pages\CreateRecord;

class CreateInspection extends CreateRecord
{
    protected static string $resource = InspectionResource::class;
    protected function afterCreate(): void
    {
        $customer_id = $this->data['customer_id'];
        $date = $this->data['date'];
        $user_id = $this->data['user_id'];

        $inspection = Inspection::query()
            ->where(['user_id' => $user_id, 'date' => $date, 'customer_id' => $customer_id])
            ->get()
            ->each(function($inspection) {

                $inspection_id = $inspection->id; // get inspection id

                $locations = $inspection->customer->locations;
                $locations->each(function($location) use ($inspection_id){

                    $departments = $location->departments;
                    $departments->each(function($department) use ($inspection_id) {

                        $spaces = $department->spaces;
                        $spaces->each(function($space) use ($inspection_id) {

                            $machines = $space->machines;
                            $machines->each(function($machine) use ($inspection_id) {

                                $space_id = $machine->pivot->space_id;
                                $machine_id = $machine->id;
                                $inventory_number = $machine->pivot->inventory_number;

                                $space_machines = SpaceMachine::query()
                                    ->where(['space_id' => $space_id, 'machine_id' => $machine_id, 'inventory_number' => $inventory_number])
                                    ->get();

                                $space_machines->each(function($space_machine) use ($machine, $inspection_id)  {
                                    $space_machine_id = $space_machine->id; // get space_machine id
                                    $inspectionList = $machine->inspectionList;

                                    if ($inspectionList == null) {
                                        return;
                                    }

                                    $questions = $inspectionList->questions;
                                    $questions->each(function($question) use ($inspection_id, $space_machine_id) {
                                        $question_id = $question->id; // get question id
                                        InspectionMachineResult::create([
                                            'inspection_id' => $inspection_id,
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
            });
    }
}
