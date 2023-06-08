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
                                                            <table>
                                                                <tbody>
                                                                    @foreach($machines as $machine)
                                                                        <tr>
                                                                            <td class="pl-6">{{ $machine['machine'] }}</td>
                                                                            <td class="pl-5">{{$machine['state']}}</td>
                                                                            <td class="pl-5">
                                                                                <a href="/inspecties/{{$inspection->id}}/uitvoeren/{{$machine['space_machine_id']}}">
                                                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                                                        <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z" />
                                                                                        <path fill-rule="evenodd" d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm9.707 5.707a1 1 0 00-1.414-1.414L9 12.586l-1.293-1.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                                                                    </svg>
                                                                                </a>
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
