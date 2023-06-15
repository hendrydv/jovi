<?php

namespace App\Filament\Resources\InspectionTypesResource\Pages;

use App\Filament\Resources\InspectionTypeResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditInspectionType extends EditRecord
{
    protected static string $resource = InspectionTypeResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
