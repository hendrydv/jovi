<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'contract_start_date',
        'contract_end_date',
        'active',
        'preferred_month',
        'notes',
    ];

    public function locations()
    {
        return $this->hasMany(Location::class);
    }
}