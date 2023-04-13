<?php

namespace App\Filament\Widgets;

use App\Models\Inspection;
use Auth;
use Saade\FilamentFullCalendar\Widgets\Concerns\CantManageEvents;
use Saade\FilamentFullCalendar\Widgets\FullCalendarWidget;

class CalendarWidget extends FullCalendarWidget
{
    use CantManageEvents;

    /**
     * Return events that should be rendered statically on calendar.
     */
    public function getViewData(): array
    {
        $inspections = Inspection::where('user_id', Auth::id())->get();

        $events = [];

        foreach ($inspections as $inspection) {
            $events[] = [
                'id' => $inspection->id,
                'title' => "{$inspection->space?->fullSpaceName()} - {$inspection->machine->fullMachineName()}",
                'start' => $inspection->date,
//                'url' => '/inspections/' . $inspection->id,
//                'shouldOpenInNewTab' => true,
            ];
        }

        return $events;
    }

    /**
     * FullCalendar will call this function whenever it needs new event data.
     * This is triggered when the user clicks prev/next or switches views on the calendar.
     */
    public function fetchEvents(array $fetchInfo): array
    {
        // You can use $fetchInfo to filter events by date.
        return [];
    }
}
