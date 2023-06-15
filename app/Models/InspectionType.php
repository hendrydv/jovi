<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InspectionType extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'inspection_list_id',
    ];

    public function inspectionList()
    {
        return $this->belongsTo(InspectionList::class);
    }
}
