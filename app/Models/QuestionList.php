<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuestionList extends Model
{
    use HasFactory;

    public function questions()
    {
        return $this->belongsToMany(
            Question::class,
            'questions_machines',
            'machine_id',
            'question_id',
        );
    }
}
