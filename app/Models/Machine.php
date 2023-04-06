<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Machine extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'supplier',
        'image',
    ];

    public function spaces()
    {
        return $this->belongsToMany(
            Space::class,
            'machines_spaces',
            'machine_id',
            'space_id',
        );
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function kind()
    {
        return $this->belongsTo(Kind::class);
    }

    public function inspectionList()
    {
        return $this->belongsTo(InspectionList::class);
    }
}
