<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Space extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'department_id',
    ];

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function machines()
    {
        return $this->belongsToMany(
            Machine::class,
            'machines_spaces',
            'space_id',
            'machine_id',
        );
    }
}
