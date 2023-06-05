<?php

namespace App\Filament\Resources\InspectionResource\Pages;

use App\Filament\Resources\InspectionResource;
use App\Filament\Resources\InspectionResource\Widgets\ExecuteInspectionWidget;
use Filament\Resources\Pages\Page;

class ExecuteInspection extends Page
{
    protected static string $resource = InspectionResource::class;

    protected static string $view = 'filament.resources.inspection-resource.pages.execute-inspection';

    public function getHeaderWidgets(): array
    {
        return [
            ExecuteInspectionWidget::class,
        ];
    }
}
