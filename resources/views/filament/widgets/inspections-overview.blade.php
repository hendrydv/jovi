<x-filament::widget>
    <x-filament::card>
        <div class="hs-accordion-group">
            @foreach ($inspectionMachines as $customer => $locations)

                @php ($customer_id = Str::slug($customer))

                <div class="hs-accordion active" id="hs-basic-nested-heading-{{$customer_id}}">
                    <button class="hs-accordion-toggle hs-accordion-active:text-blue-600 py-3 inline-flex items-center gap-x-3 w-full font-semibold text-left text-gray-800 transition hover:text-gray-500 dark:hs-accordion-active:text-blue-500 dark:text-gray-200 dark:hover:text-gray-400" aria-controls="hs-basic-nested-collapse-{{$customer_id}}">
                        <svg class="hs-accordion-active:hidden hs-accordion-active:text-blue-600 hs-accordion-active:group-hover:text-blue-600 block w-3 h-3 text-gray-600 group-hover:text-gray-500 dark:text-gray-400" width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M2.62421 7.86L13.6242 7.85999" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                            <path d="M8.12421 13.36V2.35999" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                        </svg>
                        <svg class="hs-accordion-active:block hs-accordion-active:text-blue-600 hs-accordion-active:group-hover:text-blue-600 hidden w-3 h-3 text-gray-600 group-hover:text-gray-500 dark:text-gray-400" width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M2.62421 7.86L13.6242 7.85999" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                        </svg>
                        {{$customer}}
                    </button>
                    <div id="hs-basic-nested-collapse-{{$customer_id}}" class="hs-accordion-content w-full overflow-hidden transition-[height] duration-300" aria-labelledby="hs-basic-nested-heading-{{$customer_id}}">
                        <div class="hs-accordion-group pl-6">
                            @foreach ($locations as $location => $departments)
                                @php ($location_id = Str::slug($location))
                                <div class="hs-accordion active" id="hs-basic-nested-sub-heading-{{$location_id}}">
                                    <button class="hs-accordion-toggle hs-accordion-active:text-blue-600 py-3 inline-flex items-center gap-x-3 w-full font-semibold text-left text-gray-800 transition hover:text-gray-500 dark:hs-accordion-active:text-blue-500 dark:text-gray-200 dark:hover:text-gray-400" aria-controls="hs-basic-nested-sub-collapse-{{$location_id}}">
                                        <svg class="hs-accordion-active:hidden hs-accordion-active:text-blue-600 hs-accordion-active:group-hover:text-blue-600 block w-3 h-3 text-gray-600 group-hover:text-gray-500 dark:text-gray-400" width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M2.62421 7.86L13.6242 7.85999" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                                            <path d="M8.12421 13.36V2.35999" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                                        </svg>
                                        <svg class="hs-accordion-active:block hs-accordion-active:text-blue-600 hs-accordion-active:group-hover:text-blue-600 hidden w-3 h-3 text-gray-600 group-hover:text-gray-500 dark:text-gray-400" width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M2.62421 7.86L13.6242 7.85999" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                                        </svg>
                                        {{$location}}
                                    </button>
                                    <div id="hs-basic-nested-sub-collapse-{{$location_id}}" class="hs-accordion-content w-full overflow-hidden transition-[height] duration-300" aria-labelledby="hs-basic-nested-sub-heading-{{$location_id}}">
                                        <p class="text-gray-800 dark:text-gray-200">
                                            <em>This is the third item's accordion body.</em> It is hidden by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions.
                                        </p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </x-filament::card>
</x-filament::widget>



{{--            <div class="hs-accordion" id="hs-basic-nested-heading-two">--}}
{{--                <button class="hs-accordion-toggle hs-accordion-active:text-blue-600 py-3 inline-flex items-center gap-x-3 w-full font-semibold text-left text-gray-800 transition hover:text-gray-500 dark:hs-accordion-active:text-blue-500 dark:text-gray-200 dark:hover:text-gray-400" aria-controls="hs-basic-nested-collapse-two">--}}
{{--                    <svg class="hs-accordion-active:hidden hs-accordion-active:text-blue-600 hs-accordion-active:group-hover:text-blue-600 block w-3 h-3 text-gray-600 group-hover:text-gray-500 dark:text-gray-400" width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">--}}
{{--                        <path d="M2.62421 7.86L13.6242 7.85999" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>--}}
{{--                        <path d="M8.12421 13.36V2.35999" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>--}}
{{--                    </svg>--}}
{{--                    <svg class="hs-accordion-active:block hs-accordion-active:text-blue-600 hs-accordion-active:group-hover:text-blue-600 hidden w-3 h-3 text-gray-600 group-hover:text-gray-500 dark:text-gray-400" width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">--}}
{{--                        <path d="M2.62421 7.86L13.6242 7.85999" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>--}}
{{--                    </svg>--}}
{{--                    Accordion #2--}}
{{--                </button>--}}
{{--                <div id="hs-basic-nested-collapse-two" class="hs-accordion-content hidden w-full overflow-hidden transition-[height] duration-300" aria-labelledby="hs-basic-nested-heading-two">--}}
{{--                    <p class="text-gray-800 dark:text-gray-200">--}}
{{--                        <em>This is the second item's accordion body.</em> It is hidden by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions.--}}
{{--                    </p>--}}
{{--                </div>--}}
{{--            </div>--}}

{{--            <div class="hs-accordion" id="hs-basic-nested-heading-three">--}}
{{--                <button class="hs-accordion-toggle hs-accordion-active:text-blue-600 py-3 inline-flex items-center gap-x-3 w-full font-semibold text-left text-gray-800 transition hover:text-gray-500 dark:hs-accordion-active:text-blue-500 dark:text-gray-200 dark:hover:text-gray-400" aria-controls="hs-basic-nested-collapse-three">--}}
{{--                    <svg class="hs-accordion-active:hidden hs-accordion-active:text-blue-600 hs-accordion-active:group-hover:text-blue-600 block w-3 h-3 text-gray-600 group-hover:text-gray-500 dark:text-gray-400" width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">--}}
{{--                        <path d="M2.62421 7.86L13.6242 7.85999" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>--}}
{{--                        <path d="M8.12421 13.36V2.35999" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>--}}
{{--                    </svg>--}}
{{--                    <svg class="hs-accordion-active:block hs-accordion-active:text-blue-600 hs-accordion-active:group-hover:text-blue-600 hidden w-3 h-3 text-gray-600 group-hover:text-gray-500 dark:text-gray-400" width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">--}}
{{--                        <path d="M2.62421 7.86L13.6242 7.85999" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>--}}
{{--                    </svg>--}}
{{--                    Accordion #3--}}
{{--                </button>--}}
{{--                <div id="hs-basic-nested-collapse-three" class="hs-accordion-content hidden w-full overflow-hidden transition-[height] duration-300" aria-labelledby="hs-basic-nested-heading-three">--}}
{{--                    <p class="text-gray-800 dark:text-gray-200">--}}
{{--                        <em>This is the first item's accordion body.</em> It is hidden by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions.--}}
{{--                    </p>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}

{{--        <div id="accordion-open" data-accordion="open">--}}


{{--            <h2 id="accordion-open-heading-1">--}}
{{--                <button type="button" class="flex items-center justify-between w-full p-5 font-medium text-left text-gray-500 border border-b-0 border-gray-200 rounded-t-xl focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-800 dark:border-gray-700 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800" data-accordion-target="#accordion-open-body-1" aria-expanded="true" aria-controls="accordion-open-body-1">--}}
{{--                    <span class="flex items-center"><svg class="w-5 h-5 mr-2 shrink-0" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-3a1 1 0 00-.867.5 1 1 0 11-1.731-1A3 3 0 0113 8a3.001 3.001 0 01-2 2.83V11a1 1 0 11-2 0v-1a1 1 0 011-1 1 1 0 100-2zm0 8a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd"></path></svg> What is Flowbite?</span>--}}
{{--                    <svg data-accordion-icon class="w-6 h-6 rotate-180 shrink-0" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>--}}
{{--                </button>--}}
{{--            </h2>--}}

{{--            <div id="accordion-open-body-1" class="hidden" aria-labelledby="accordion-open-heading-1">--}}
{{--                test--}}

{{--                <div id="accordion-open" data-accordion="open">--}}
{{--                    <h2 id="accordion-open-heading-10"></h2>--}}
{{--                    <div id="accordion-open-body-10" class="hidden" aria-labelledby="accordion-open-heading-10">--}}
{{--                            testtest--}}
{{--                    </div>--}}
{{--                    </div>--}}
{{--                </div>--}}

{{--            </div>--}}





{{--            <h2 id="accordion-open-heading-2">--}}
{{--                <button type="button" class="flex items-center justify-between w-full p-5 font-medium text-left text-gray-500 border border-b-0 border-gray-200 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-800 dark:border-gray-700 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800" data-accordion-target="#accordion-open-body-2" aria-expanded="false" aria-controls="accordion-open-body-2">--}}
{{--                    <span class="flex items-center"><svg class="w-5 h-5 mr-2 shrink-0" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-3a1 1 0 00-.867.5 1 1 0 11-1.731-1A3 3 0 0113 8a3.001 3.001 0 01-2 2.83V11a1 1 0 11-2 0v-1a1 1 0 011-1 1 1 0 100-2zm0 8a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd"></path></svg>Is there a Figma file available?</span>--}}
{{--                    <svg data-accordion-icon class="w-6 h-6 shrink-0" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>--}}
{{--                </button>--}}
{{--            </h2>--}}
{{--            <div id="accordion-open-body-2" class="hidden" aria-labelledby="accordion-open-heading-2">--}}
{{--                <div class="p-5 border border-b-0 border-gray-200 dark:border-gray-700">--}}
{{--                    <p class="mb-2 text-gray-500 dark:text-gray-400">Flowbite is first conceptualized and designed using the Figma software so everything you see in the library has a design equivalent in our Figma file.</p>--}}
{{--                    <p class="text-gray-500 dark:text-gray-400">Check out the <a href="https://flowbite.com/figma/" class="text-blue-600 dark:text-blue-500 hover:underline">Figma design system</a> based on the utility classes from Tailwind CSS and components from Flowbite.</p>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}








{{--                <x-slot name="heading">Vandaag - {{date('y-m-d')}}</x-slot>--}}
{{--        <ul class="list-disc">--}}
{{--            @foreach ($inspectionMachines as $customer => $locations)--}}
{{--                <li> {{$customer}}--}}
{{--                    <ul class="list-disc pl-5">--}}
{{--                        @foreach ($locations as $location => $departments)--}}
{{--                            <li> {{$location}}--}}
{{--                                <ul class="list-disc pl-5">--}}
{{--                                    @foreach ($departments as $department => $spaces)--}}
{{--                                        <li> {{$department}}--}}
{{--                                            <ul class="list-disc pl-5">--}}
{{--                                                @foreach ($spaces as $space => $machines)--}}
{{--                                                     <li>{{$space}}--}}
{{--                                                        <ul class="list-disc pl-5">--}}
{{--                                                            @foreach ($machines as $machine)--}}
{{--                                                                <li>{{$machine->fullMachineName()}}</li>--}}
{{--                                                            @endforeach--}}
{{--                                                         </ul>--}}
{{--                                                     </li>--}}
{{--                                                @endforeach--}}
{{--                                            </ul>--}}
{{--                                        </li>--}}
{{--                                    @endforeach--}}
{{--                                </ul>--}}
{{--                            </li>--}}
{{--                        @endforeach--}}
{{--                    </ul>--}}
{{--                </li>--}}
{{--            @endforeach--}}
{{--        </ul>--}}


