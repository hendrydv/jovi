<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class InspectionMachineResult extends Model
{
    use HasFactory;

    public const RESULT_TYPES = [
        'pass' => 'Pass',
        'fail' => 'Fail',
        'na' => 'N/A',
    ];

    protected $fillable = [
        'inspection_id',
        'space_machine_id',
        'question_id',
        'option_id',
        'result',
    ];

    public function question(): BelongsTo
    {
        return $this->belongsTo(Question::class);
    }

    public function space_machine(): BelongsTo
    {
        return $this->belongsTo(SpaceMachine::class);
    }
}
