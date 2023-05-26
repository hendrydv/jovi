<x-filament::widget>
    <x-filament::card>
        @if (sizeof($inspectionMachines) === 0)
            <div class="p-6 text-center text-gray-600">
                {{ ('Geen openstaande inspecties') }}
            </div>
        @else
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
                                                                <ul class="list-disc pl-10">
                                                                    @foreach($machines as $machine)
                                                                        <li>
                                                                            {{ $machine->fullMachineName() }}
                                                                        </li>
                                                                    @endforeach
                                                                </ul>
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
        @endif
    </x-filament::card>
</x-filament::widget>
