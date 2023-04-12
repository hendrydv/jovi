<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Machine extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'supplier',
        'image',
    ];

    public function spaces(): BelongsToMany
    {
        return $this->belongsToMany(
            Space::class,
            'machines_spaces',
            'machine_id',
            'space_id',
        );
    }

    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }

    public function kind(): BelongsTo
    {
        return $this->belongsTo(Kind::class);
    }

    public function inspectionList(): BelongsTo
    {
        return $this->belongsTo(InspectionList::class);
    }
}
