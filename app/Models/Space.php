<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;

class Space extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'department_id',
    ];

    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }

    public function machines(): BelongsToMany
    {
        return $this->belongsToMany(
            Machine::class,
            'machines_spaces',
            'space_id',
            'machine_id',
        )->withPivot('inventory_number');
    }

    public function location(): HasOneThrough
    {
        return $this->hasOneThrough(
            Location::class,
            Department::class,
            'id',
            'id',
            'department_id',
            'location_id'
        );
    }

    public function fullSpaceName(): string
    {
        return "{$this->department?->location?->customer?->name} {$this->department?->location?->name} {$this->department?->name} {$this->name}";
    }
}
