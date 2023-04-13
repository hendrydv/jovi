<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Question extends Model
{
    use HasFactory;

    protected $fillable = [
        'question',
    ];

    public function inspectionLists(): BelongsToMany
    {
        return $this->belongsToMany(InspectionList::class)
            ->using(InspectionListQuestion::class)
            ->withPivot('index');
    }

    public function inspectionResults()
    {
        return $this->hasMany(InspectionResult::class);
    }
}
