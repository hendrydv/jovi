<x-filament::widget>
    <x-filament::card>
        <x-accordion.list>
            @foreach ($inspectionMachines as $customer => $locations)
                <x-accordion.item :name="$customer" :first="$loop->first">
                    <x-accordion.list>
                        @foreach ($locations as $location => $departments)
                            <x-accordion.item :name="$location" :first="$loop->first">
                                <x-accordion.list>
                                    @foreach($departments as $department => $spaces)
                                        <x-accordion.item :name="$department" :first="$loop->first">
                                            <x-accordion.list>
                                                @foreach($spaces as $space => $machines)
                                                    <x-accordion.item :name="$space" :first="$loop->first">
                                                        <x-accordion.list>
                                                            <table class="table-auto w-full border-collapse">
                                                                <thead>
                                                                    <tr class="bg-gray-500/5">
                                                                        <th class="border text-start px-4 py-2">Machine</th>
                                                                        <th class="border text-start px-4 py-2">Status</th>
                                                                        <th class="border text-start px-4 py-2">Actie</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    @foreach($machines as $machine)
                                                                        <tr>
                                                                            <td class="border px-4 py-3">{{ $machine['machine'] }}</td>
                                                                            <td class="border px-4 py-3">{{$machine['state']}}</td>
                                                                            <td class="border px-4 py-3">
                                                                                <x-filament::link icon="heroicon-s-pencil" href="/inspecties/{{$machine['inspection_id']}}/uitvoeren/{{$machine['space_machine_id']}}">
                                                                                    Uitvoeren
                                                                                </x-filament::link>
                                                                            </td>
                                                                        </tr>
                                                                    @endforeach
                                                                </tbody>
                                                            </table>
                                                        </x-accordion.list>
                                                    </x-accordion.item>
                                                @endforeach
                                            </x-accordion.list>
                                        </x-accordion.item>
                                    @endforeach
                                </x-accordion.list>
                            </x-accordion.item>
                        @endforeach
                    </x-accordion.list>
                </x-accordion.item>
            @endforeach
        </x-accordion.list>
    </x-filament::card>
</x-filament::widget>
