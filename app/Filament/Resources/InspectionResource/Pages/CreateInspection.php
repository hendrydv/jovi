<?php

namespace App\Filament\Resources\InspectionResource\Pages;

use App\Filament\Resources\InspectionResource;
use App\Filament\Services\InspectionMachineResultService;
use App\Models\Inspection;
use Filament\Resources\Pages\CreateRecord;

class CreateInspection extends CreateRecord
{
    protected static string $resource = InspectionResource::class;

    protected function afterCreate(): void
    {
        $inspection = Inspection::where([
            'user_id' => $this->data['user_id'],
            'date' => $this->data['date'],
            'customer_id' => $this->data['customer_id']
        ])->first();

        InspectionMachineResultService::createResultsWithInspection($inspection);
    }
}
