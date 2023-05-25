<?php

namespace App\Filament\Widgets;

use App\Models\Inspection;
use App\Models\Machine;
use Filament\Widgets\Widget;

class InspectionsOverview extends Widget
{
    protected static string $view = 'filament.widgets.inspections-overview';
    protected int | string | array $columnSpan = 'full';

    public $inspectionMachines = [];

    public function mount(): void
    {
        Inspection::query()
            ->where(['user_id' => auth()->id(), 'date' => date('y-m-d')])
            ->get()->each(function($inspection){
                $customer = $inspection->customer;

                $this->inspectionMachines[$customer->name] = [];

                $locations = $inspection->customer->locations;

                $locations->each(function($location) use ($customer) {
                    $this->inspectionMachines[$customer->name][$location->fullAddress()] = [];

                    $departments = $location->departments;

                        $departments->each(function($department) use ($location, $customer) {

                            $this->inspectionMachines[$customer->name][$location->fullAddress()][$department->name] = [];

                            $spaces = $department->spaces;

                                $spaces->each(function($space) use ($location, $department, $customer) {

                                    $machines = $space->machines;
                                    $this->inspectionMachines[$customer->name][$location->fullAddress()][$department->name][$space->name] = $machines;
                                });
                        });
                });
            });
    }
}
