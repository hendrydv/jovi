<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class InspectionList extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function questions(): BelongsToMany
    {
        return $this->belongsToMany(Question::class)
            ->using(InspectionListQuestion::class)
            ->withPivot('index');
    }

    public function inspectionType(): BelongsTo
    {
        return $this->belongsTo(InspectionType::class);
    }
}
