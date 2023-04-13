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
        'space_id',
        'machine_id',
        'user_id',
        'date',
        'notes',
    ];

    public function space(): BelongsTo
    {
        return $this->belongsTo(Space::class);
    }

    public function machine(): BelongsTo
    {
        return $this->belongsTo(Machine::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function inspectionResults(): HasMany
    {
        return $this->hasMany(InspectionResult::class);
    }
}
