<?php

namespace App\Http\Controllers;

use App\Models\Inspection;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class DownloadPdfController extends Controller
{
    public function download(Inspection $record)
    {
        $customer = $record->customer->name;
        $date = $record->date;
        $pdf = Pdf::setOption('isPhpEnabled', true);
        $pdf->loadView('pdf.inspection',['record'=>$record]);
        return $pdf->stream("$customer-$date-inspectie.pdf");
    }
}
