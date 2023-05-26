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
                                                                            <td class="pl-6">{{ $machine->fullMachineName() }}</td>
                                                                            <td class="pl-5">Nog niet gekeurd</td>
                                                                            <td class="pl-5">Open</td>
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
