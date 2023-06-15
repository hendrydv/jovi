<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'contract_start_date',
        'contract_end_date',
        'is_active',
        'preferred_month',
        'notes',
    ];

    public const MONTHS = [
        'january' => 'Januari',
        'february' => 'Februari',
        'march' => 'Maart',
        'april' => 'April',
        'may' => 'Mei',
        'june' => 'Juni',
        'july' => 'Juli',
        'august' => 'Augustus',
        'september' => 'September',
        'october' => 'Oktober',
        'november' => 'November',
        'december' => 'December',
    ];

    public function locations(): HasMany
    {
        return $this->hasMany(Location::class);
    }
}
