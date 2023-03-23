<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;

    protected $fillable = [
        'street',
        'house_number',
        'zip_code',
        'city',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function departments()
    {
        return $this->hasMany(Department::class);
    }
}
