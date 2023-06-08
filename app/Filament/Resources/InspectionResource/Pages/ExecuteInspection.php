<?php

namespace App\Filament\Resources\InspectionResource\Pages;

use App\Filament\Resources\InspectionResource;
use App\Filament\Resources\InspectionResource\Widgets\ExecuteInspectionWidget;
use App\Models\Inspection;
use App\Models\InspectionMachineResult;
use Filament\Notifications\Notification;
use Filament\Pages\Actions\Action;
use Filament\Resources\Pages\Page;
use Illuminate\Support\Facades\Route;

class ExecuteInspection extends Page
{
    protected static string $resource = InspectionResource::class;

    protected static string $view = 'filament.resources.inspection-resource.pages.execute-inspection';

    protected static ?string $title = "Inspectie uitvoeren";

    protected function getActions(): array
    {
        $inspection = Route::current()->parameter('inspection');
        $spaceMachine = Route::current()->parameter('spaceMachine');
        if ($inspection && $spaceMachine) {
            request()->session()->put("inspection_$this->id", $inspection);
            request()->session()->put("space_machine_$this->id", $spaceMachine);
        }

        return [
            Action::make('Terug naar dashboard')
                ->color('secondary')
                ->iconPosition('before')
                ->icon('heroicon-o-home')
                ->url('/'),
            Action::make('Volgende inspectie')
                ->color('primary')
                ->iconPosition('after')
                ->icon('heroicon-o-arrow-right')
                ->action(function () {
                    $inspection = request()->session()->get("inspection_$this->id");
                    $spaceMachine = request()->session()->get("space_machine_$this->id");

                    $inspectionResult = InspectionMachineResult::query()
                        ->select('space_machine_id')
                        ->where([
                            'inspection_id' => $inspection,
                            'result' => null
                        ])
                        ->where('space_machine_id', '!=', $spaceMachine)
                        ->groupBy('space_machine_id')
                        ->first();

                    if (!$inspectionResult) {
                        $customer = Inspection::find($inspection)->customer->name;
                        Notification::make()
                            ->title("Alle machines van $customer zijn geïnspecteerd,
                                u wordt nu terug naar het dashboard gestuurd.")
                            ->success()
                            ->send();
                        redirect('/');
                        return null;
                    }

                    return redirect(route('filament.resources.inspecties.execute', [
                        'inspection' => $inspection,
                        'spaceMachine' => $inspectionResult->space_machine_id
                    ]));
                })

        ];
    }

    public function getHeaderWidgets(): array
    {
        return [
            ExecuteInspectionWidget::class,
        ];
    }
}
