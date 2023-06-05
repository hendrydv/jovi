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
    </div>
</div>
<div class="Inspection-details">
    <p>Inspectie datum: {{$record->date}}</p>
    <p>Inspectie locatie: {{$record->location}}</p>
    <p>Inspectie uitgevoerd door: {{$record->user->name}}</p>
</div>
<div class="Inspection-table">
    <table>
        <thead>
        <tr>
            <th>Machine:</th>
            <th>Vraag:</th>
            <th>Resultaat:</th>
            <th>Notitie:</th>
        </tr>
        </thead>
        <tbody>
        {{$oldMachine = null}}
        {{$oldSpace = null}}
        @foreach($record->results as $result)
{{--            <tr>--}}
{{--                {{$result->space_machine->space->fullSpaceName()}}--}}
{{--            </tr>--}}
            <tr>
                <td>@if($result->space_machine->machine->fullMachineName() != $oldMachine){{$result->space_machine->machine->fullMachineName()}}@endif</td>
                <td>{{$result->question->question}}</td>
                <td>@if($result->result != null){{$result->result}}@else --- @endif</td>
                <td>notitie</td>
            </tr>
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
            $y = 800;
            $x = 260;
            $pdf->text($x, $y, $pageText, $font, $size);
        }
    ');
}
</script>
</body>
