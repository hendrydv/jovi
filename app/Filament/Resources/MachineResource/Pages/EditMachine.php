<?php

namespace App\Filament\Resources\MachineResource\Pages;

use App\Filament\Resources\MachineResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMachine extends EditRecord
{
    protected static string $resource = MachineResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
