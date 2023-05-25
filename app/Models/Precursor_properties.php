<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Precursor_properties extends Model
{
    use HasFactory;

    public $timestamps = false;

    public function gasFlows()
    {
        return $this->hasMany(Gas_flow::class);
    }

    public function sources()
    {
        return $this->hasMany(Source::class);
    }
}
