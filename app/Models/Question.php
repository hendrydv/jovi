<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Question extends Model
{
    use HasFactory;

    protected $fillable = [
        'question',
    ];

    public function options(): BelongsToMany
    {
        return $this->belongsToMany(
            Option::class,
            'questions_options',
            'question_id',
            'option_id',
        );
    }

    public function inspectionLists(): BelongsToMany
    {
        return $this->belongsToMany(InspectionList::class)
            ->using(InspectionListQuestion::class)
            ->withPivot('index');
    }

    public function inspectionMachineResults(): HasMany
    {
        return $this->hasMany(InspectionMachineResult::class);
    }
}
