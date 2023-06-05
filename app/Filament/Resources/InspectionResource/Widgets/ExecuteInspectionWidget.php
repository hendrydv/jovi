<?php

namespace App\Filament\Resources\InspectionResource\Widgets;

use App\Models\InspectionMachineResult;
use Filament\Tables\Columns\SelectColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Route;

class ExecuteInspectionWidget extends BaseWidget
{
    protected int | string | array $columnSpan = 'full';

    protected function getTableQuery(): Builder
    {
        $inspection = Route::current()->parameter('inspection');
        $spaceMachine = Route::current()->parameter('spaceMachine');

        if ($inspection && $spaceMachine) {
            Cache::put('inspection', $inspection);
            Cache::put('spaceMachine', $spaceMachine);
        } else {
            $inspection = Cache::get('inspection');
            $spaceMachine = Cache::get('spaceMachine');
        }

        return InspectionMachineResult::query()->where([
            'inspection_id' => $inspection,
            'space_machine_id' => $spaceMachine
        ]);
    }

    protected function getTableColumns(): array
    {
        return [
            TextColumn::make('question.question')
                ->translateLabel(),
            SelectColumn::make('result')
                ->translateLabel()
                ->options(InspectionMachineResult::RESULT_TYPES),
        ];
    }

    protected function isTablePaginationEnabled(): bool
    {
        return false;
    }
}
