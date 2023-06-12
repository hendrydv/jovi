<?php

namespace App\Exports;

use App\Models\Inspection;
use Maatwebsite\Excel\Concerns\FromView;

class InspectionExport implements FromView
{
    private Inspection $record;

    public function __construct(Inspection $record)
    {
        $this->record = $record;
    }

    public function view(): \Illuminate\Contracts\View\View
    {
        return view ('excel.inspection', ['record' => $this->record]);
    }
}
