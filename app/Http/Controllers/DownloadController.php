<?php

namespace App\Http\Controllers;

use App\Exports\InspectionExport;
use App\Models\Inspection;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class DownloadController extends Controller
{
    public function downloadPdf(Inspection $record)
    {
        $customer = $record->customer->name;
        $date = $record->date;
        $pdf = Pdf::setOption('isPhpEnabled', true);
        $pdf = $pdf->setOption('isRemoteEnabled', true);
        $pdf->loadView('pdf.inspection',['record'=>$record]);
        return $pdf->stream("$customer-$date-inspectie.pdf");
    }

    public function downloadExcel(Inspection $record)
    {
        $customer = $record->customer->name;
        $date = $record->date;
        return Excel::download(new InspectionExport($record), "$customer-$date-inspectie.xlsx");
    }
}
