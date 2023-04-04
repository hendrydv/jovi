<?php

namespace App\Filament\Resources\InspectionListResource\Pages;

use App\Filament\Resources\InspectionListResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditInspectionList extends EditRecord
{
    protected static string $resource = InspectionListResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
