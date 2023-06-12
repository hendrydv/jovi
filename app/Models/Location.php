<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Location extends Model
{
    use HasFactory;

    protected $fillable = [
        'street',
        'house_number',
        'zip_code',
        'city',
    ];

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function departments(): HasMany
    {
        return $this->hasMany(Department::class);
    }

    public function fullAddress(): string
    {
        return "$this->street $this->house_number, $this->zip_code $this->city";
    }

    public function fullAddressArr(): array
    {
        return [
            $this->street,
            $this->house_number,
            $this->zip_code,
            $this->city,
        ];
    }
}
