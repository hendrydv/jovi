<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Machine extends Model
{
    use HasFactory;

    public function spaces()
    {
        return $this->belongsToMany(
            Space::class,
            'machines_spaces',
            'machine_id',
            'space_id',
        );
    }
}
