<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpaceMachine extends Model
{
    use HasFactory;

    public function space()
    {
        return $this->belongsTo(Space::class);
    }

    public function machine()
    {
        return $this->belongsTo(Machine::class);
    }
}
