<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;

class InspectionListQuestion extends Pivot implements Sortable
{
    use SortableTrait;

    public array $sortable = [
        'order_column_name' => 'index',
    ];

    public function buildSortQuery(): Builder
    {
        return static::query()->where('inspection_list_id', $this->inspection_list_id);
    }
}
