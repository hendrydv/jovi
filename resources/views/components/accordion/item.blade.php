@props(['name', 'first'])

@php ($slug = Str::slug($name))

<div class="hs-accordion @if($first)active @endif" id="accordion-{{ $slug }}">
    <div class="hs-accordion-group pl-6">
        <button class="hs-accordion-toggle hs-accordion-active:text-blue-600 group py-3 inline-flex items-center gap-x-3 w-full font-semibold text-left text-gray-800 transition hover:text-gray-500 dark:hs-accordion-active:text-blue-500 dark:text-gray-200 dark:hover:text-gray-400" aria-controls="accordion-{{ $slug }}">
            <svg class="hs-accordion-active:hidden hs-accordion-active:text-blue-600 hs-accordion-active:group-hover:text-blue-600 block w-3 h-3 text-gray-600 group-hover:text-gray-500 dark:text-gray-400" width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M2.62421 7.86L13.6242 7.85999" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                <path d="M8.12421 13.36V2.35999" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
            </svg>
            <svg class="hs-accordion-active:block hs-accordion-active:text-blue-600 hs-accordion-active:group-hover:text-blue-600 hidden w-3 h-3 text-gray-600 group-hover:text-gray-500 dark:text-gray-400" width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M2.62421 7.86L13.6242 7.85999" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
            </svg>
            {{ $name }}
        </button>
        <div id="accordion-{{ $slug }}" class="hs-accordion-content @if(!$first) hidden @endif w-full overflow-hidden transition-[height] duration-300" aria-labelledby="accordion-{{ $slug }}">
            {{ $slot }}
        </div>
    </div>
</div>
