<?php

namespace App\Filament\Resources\InspectionTypesResource\Pages;

use App\Filament\Resources\InspectionTypesResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListInspectionTypes extends ListRecords
{
    protected static string $resource = InspectionTypesResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
