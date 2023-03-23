<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'location_id',
    ];

    public function location()
    {
        return $this->belongsTo(location::class);
    }

    public function spaces()
    {
        return $this->hasMany(Space::class);
    }
}
