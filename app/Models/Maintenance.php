<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Maintenance extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'description',
        'gravity',
        'equipment_id',
    ];

    public $timestamps = false;

    public function equipment()
    {
        return $this->belongsTo(Equipment::class, 'equipment_id');
    }
}
