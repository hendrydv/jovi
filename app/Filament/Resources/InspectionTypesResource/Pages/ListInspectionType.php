<?php

namespace App\Filament\Resources\InspectionTypesResource\Pages;

use App\Filament\Resources\InspectionTypeResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListInspectionType extends ListRecords
{
    protected static string $resource = InspectionTypeResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
