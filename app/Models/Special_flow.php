<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Special_flow extends Model
{
    use HasFactory;

    protected $fillable = [
        'inject_final_value',
        'MO_pressure',
        'MO_temperature',
        'dilute_value',
        'source_value',
    ];

    public $timestamps = false;

    public function gasFlow()
    {
        return $this->hasOne(Gas_flow::class);
    }
}
