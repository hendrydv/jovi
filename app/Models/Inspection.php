<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

/**
 * @mixin Builder
 */
class Inspection extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'user_id',
        'date',
        'notes',
    ];

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function results(): HasMany
    {
        return $this->hasMany(InspectionMachineResult::class, 'inspection_id', 'id');
    }

    public function space_machines(): HasManyThrough
    {
        return $this->hasManyThrough(
            SpaceMachine::class,
            InspectionMachineResult::class,
            'inspection_id',
            'id',
            'id',
            'space_machine_id'
        )->distinct();
    }
}
