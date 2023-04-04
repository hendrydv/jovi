<?php

namespace App\Filament\Resources\InspectionListResource\Pages;

use App\Filament\Resources\InspectionListResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListInspectionLists extends ListRecords
{
    protected static string $resource = InspectionListResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
