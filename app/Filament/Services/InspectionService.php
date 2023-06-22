<?php

namespace App\Filament\Services;

use App\Models\Inspection;
use App\Models\InspectionMachineResult;
use App\Models\SpaceMachine;

class InspectionService
{
    public const NOT_STARTED = 'Niet begonnen';
    public const STARTED = 'Begonnen';
    public const FINISHED = 'Afgerond';

    public static function getInspectionState(Inspection $inspection, SpaceMachine $spaceMachine): string
    {
        $inspectionMachineResults = InspectionMachineResult::query()
            ->select('result')
            ->where(['inspection_id' => $inspection->id, 'space_machine_id' => $spaceMachine->id])
            ->get()
            ->toArray();

        return InspectionMachineResultService::getStateFromInspectionMachineResults($inspectionMachineResults);
    }
}
