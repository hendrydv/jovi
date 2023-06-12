<?php

namespace App\Filament\Resources\InspectionTypesResource\Pages;

use App\Filament\Resources\InspectionTypesResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditInspectionTypes extends EditRecord
{
    protected static string $resource = InspectionTypesResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
