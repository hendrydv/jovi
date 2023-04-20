<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Option extends Model
{
    use HasFactory;

    protected $fillable = [
        'option',
    ];

    public function questions(): BelongsToMany
    {
        return $this->belongsToMany(
            Question::class,
            'questions_options',
            'question_id',
            'option_id',
        );
    }

}
