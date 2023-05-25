<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gas_flow extends Model
{
    use HasFactory;

    protected $fillable = [
        'inject_initial_value',
        'cvr_step_id',
        'source_id',
        'gas_line_id',
        'special_flow_id',
        'precursor_properties_id',
    ];

    public $timestamps = false;

    public function cvrStep()
    {
        return $this->belongsTo(Cvr_step::class, 'cvr_step_id');
    }

    public function source()
    {
        return $this->belongsTo(Source::class, 'source_id');
    }

    public function precursor()
    {
        return $this->belongsTo(Precursor_properties::class, 'precursor_properties_id');
    }

    public function gasLine()
    {
        return $this->belongsTo(Gas_line::class, 'gas_line_id');
    }

    public function specialFlow()
    {
        return $this->belongsTo(Special_flow::class, 'special_flow_id');
    }
}
