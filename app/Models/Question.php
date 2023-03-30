<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $fillable = [
        'question',
    ];

    public function question_lists()
    {
        return $this->belongsToMany(
            QuestionList::class,
            'questions_question_lists',
            'question_id',
            'question_list_id',
        );
    }
}
