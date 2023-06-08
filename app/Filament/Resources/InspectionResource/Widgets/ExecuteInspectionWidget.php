<?php

namespace App\Filament\Resources\InspectionResource\Widgets;

use App\Models\Inspection;
use App\Models\InspectionMachineResult;
use App\Models\SpaceMachine;
use Filament\Tables\Columns\SelectColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\TextInputColumn;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Route;

class ExecuteInspectionWidget extends BaseWidget
{
    public function __construct($id = null)
    {
        parent::__construct($id);

        $spaceMachineId = Route::current()->parameter('spaceMachine');

        if (!$spaceMachineId) {
            $spaceMachineId = request()->session()->get("space_machine_$this->id");
        }

        $spaceMachine = SpaceMachine::find($spaceMachineId);
        $machine = $spaceMachine->machine->fullMachineName();
        static::$heading = "Inspectie uitvoeren voor: '$machine'";
    }

    protected int | string | array $columnSpan = 'full';

    protected function getTableQuery(): Builder
    {
        $inspection = Route::current()->parameter('inspection');
        $spaceMachine = Route::current()->parameter('spaceMachine');

        if ($inspection && $spaceMachine) {
            request()->session()->put("inspection_$this->id", $inspection);
            request()->session()->put("space_machine_$this->id", $spaceMachine);
        } else {
            $inspection = request()->session()->get("inspection_$this->id");
            $spaceMachine = request()->session()->get("space_machine_$this->id");
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
                ->rules(['required'])
                ->options(InspectionMachineResult::RESULT_TYPES),
            SelectColumn::make('option')
                ->translateLabel()
                ->options(function ($record) {
                    return $record->question->options->pluck('option', 'id');
                }),
            TextInputColumn::make('comment')
                ->translateLabel()
                ->rules(['required'])
        ];
    }

    protected function isTablePaginationEnabled(): bool
    {
        return false;
    }
}
