<?php

namespace App\Filament\Widgets;

use App\Filament\Services\InspectionService;
use App\Models\Inspection;
use App\Models\InspectionMachineResult;
use App\Models\SpaceMachine;
use Filament\Widgets\Widget;

class InspectionsOverview extends Widget
{
    protected static string $view = 'filament.widgets.inspections-overview';
    protected int | string | array $columnSpan = 'full';

    public $inspectionMachines = [];

    public $machines = [];

    public $inspection;

    public function mount(): void
    {
        Inspection::query()
            ->where(['user_id' => auth()->id(), 'date' => date('y-m-d')])
            ->get()->each(function($inspection){
                $this->inspection = $inspection;
                $customer = $inspection->customer;

                $this->inspectionMachines[$customer->name] = [];

                $locations = $inspection->customer->locations;
                $locations->each(function($location) use ($customer, $inspection) {
                    $this->inspectionMachines[$customer->name][$location->fullAddress()] = [];

                    $departments = $location->departments;
                    $departments->each(function($department) use ($location, $customer, $inspection) {

                        $this->inspectionMachines[$customer->name][$location->fullAddress()][$department->name] = [];

                        $spaces = $department->spaces;
                        $spaces->each(function($space) use ($location, $department, $customer, $inspection) {

                            $inspection_machine_results = InspectionMachineResult::query()
                                ->select('space_machine_id')
                                ->where(['inspection_id' => $inspection->id, 'space_machines.space_id' => $space->id])
                                ->distinct()
                                ->join('space_machines', 'inspection_machine_results.space_machine_id', '=', 'space_machines.id')
                                ->get();

                            $inspection_machine_results->each(function($inspection_machine_result) use ($inspection, $space, $location, $department, $customer) {
                                $space_machine = SpaceMachine::find($inspection_machine_result->space_machine_id);

                                $result = InspectionService::getInspectionState($inspection, $space_machine);

                                $this->machines[] = [
                                    'space_machine_id' => $space_machine->id,
                                    'machine' => $space_machine->machine->fullMachineName(),
                                    'state' => $result,
                                ];
                            });
                            $this->inspectionMachines[$customer->name][$location->fullAddress()][$department->name][$space->name] = $this->machines;
                            $this->machines = [];
                        });
                    });
                });
            });
    }
}
