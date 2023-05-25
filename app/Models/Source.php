<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Source extends Model
{
    use HasFactory;

    protected $fillable = [
        'reference',
        'supplier',
        'quantity',
        'manufacturing_date',
        'purity',
        'dilution',
        'conditionning',
        'precursor_properties_id',
    ];

    public $timestamps = false;

    public function gasFlows()
    {
        return $this->hasMany(Gas_flow::class);
    }

    public function precursor()
    {
        return $this->belongsTo(Precursor_properties::class, 'precursor_properties_id');
    }

    public function gasLines()
    {
        return $this->belongsToMany(Gas_line::class);
    }

    public function latestGasLine()
    {
        return $this->gasLines()->latest('date_in');
    }
}
