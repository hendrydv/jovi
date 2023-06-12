<table>
    <thead>
    <tr>
        <th>Locatie:</th>
        <th>Afdeling:</th>
        <th>Ruimte:</th>
        <th>Machine:</th>
        <th>Vraag:</th>
        <th>Resultaat:</th>
        <th>Optie:</th>
        <th>Notitie:</th>
    </tr>
    </thead>
    <tbody>
    {{$oldLocation = null}}
    {{$oldDepartment = null}}
    {{$oldSpace = null}}
    {{$oldMachine = null}}
    @foreach($record->results as $result)
        <tr>
            <td>@if($result->space_machine->space->department->location->fullAddress() != $oldLocation){{$result->space_machine->space->department->location->fullAddress()}}@endif</td>
            <td>@if($result->space_machine->space->department->name != $oldDepartment){{$result->space_machine->space->department->name}}@endif</td>
            <td>@if($result->space_machine->space->name != $oldSpace){{$result->space_machine->space->name}}@endif</td>
            <td>@if($result->space_machine->machine->fullMachineName() != $oldMachine){{$result->space_machine->machine->fullMachineName()}}@endif</td>
            <td>{{$result->question->question}}</td>
            <td>@if($result->result != null){{$result->result}}@else --- @endif</td>
            <td>@if($result->option != null){{$result->option}}@else --- @endif</td>
            <td>@if($result->comment != null){{$result->comment}}@else --- @endif</td>
        </tr>
        {{$oldLocation = $result->space_machine->space->department->location->fullAddress()}}
        {{$oldDepartment = $result->space_machine->space->department->name}}
        {{$oldSpace = $result->space_machine->space->name}}
        {{$oldMachine = $result->space_machine->machine->fullMachineName()}}
    @endforeach
    </tbody>
</table>
