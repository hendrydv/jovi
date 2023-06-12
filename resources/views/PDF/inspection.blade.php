<head>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        tr:nth-child(even) {
            background-color: #FFCBD1;
        }
    </style>
</head>
<body>
<header>
    <img src="{{Vite::asset('resources/images/jovi.png')}}" alt="Logo" class="h-16">
    <h1>Inspectie rapport:</h1>
</header>
<div class="company-info">
    <p>Bedrijfsnaam: {{$record->customer->name}}</p>
    <div class="address">
        @php $addresArr = $record->results->First()->space_machine->space->department->location->fullAddressArr()@endphp
        <p>Adresgegevens:</p>
        <p>{{$addresArr[0]}}, {{$addresArr[1]}}</p>
        <p>{{$addresArr[3]}}, {{$addresArr[2]}}</p>
    </div>
</div>
<div class="Inspection-details">
    <p>Inspectie datum: {{$record->date}}</p>
    <p>Inspectie locatie: {{$record->results->First()->space_machine->space->department->location->fullAddress()}}</p>
    <p>Inspectie uitgevoerd door: {{$record->user->name}}</p>
</div>
<div class="Inspection-table">
    {{$oldDepartment = null}}
    {{$oldSpace = null}}
    {{$oldMachine = null}}
    @foreach($record->results as $result)
        @if($result->space_machine->space->department->name != $oldDepartment)
            <h3>Afdeling: {{$result->space_machine->space->department->name}}</h3>
            @php $oldDepartment = $result->space_machine->space->department->name @endphp
            @endif

            @if($result->space_machine->space->name != $oldSpace)
                @if(!is_null($oldSpace))
                    </tbody>
            </table>
        @endif
        <h4>Ruimte: {{$result->space_machine->space->name}}</h4>
        <table>
            <thead>
            <tr>
                <th>Machine:</th>
                <th>Vraag:</th>
                <th>Resultaat:</th>
                <th>Optie:</th>
                <th>Notitie:</th>
            </tr>
            </thead>
            <tbody>
            @endif

            <tr>
                <td>@if($result->space_machine->machine->fullMachineName() != $oldMachine){{$result->space_machine->machine->fullMachineName()}}@endif</td>
                <td>{{$result->question->question}}</td>
                <td>@if($result->result != null){{$result->result}}@else --- @endif</td>
                <td>@if($result->option != null){{$result->option->option}}@else --- @endif</td>
                <td>@if($result->comment != null){{$result->comment}}@else --- @endif</td>
            </tr>

            {{$oldSpace = $result->space_machine->space->name}}
            {{$oldMachine = $result->space_machine->machine->fullMachineName()}}

            @endforeach

            </tbody>
        </table>
</div>
<script type="text/php">
if ( isset($pdf) ) {
$pdf->page_script('
if ($PAGE_COUNT > 1) {
$font = $fontMetrics->get_font("Arial, Helvetica, sans-serif", "normal");
$size = 12;
$pageText = "Pagina " . $PAGE_NUM . " van " . $PAGE_COUNT;
$y = 810;
$x = 260;
$pdf->text($x, $y, $pageText, $font, $size);
}
');
}
</script>
</body>
