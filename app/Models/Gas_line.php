<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gas_line extends Model
{
    use HasFactory;

    public $timestamps = false;

    public function gasFlows()
    {
        return $this->hasMany(Gas_flow::class);
    }

    public function equipments()
    {
        return $this->belongsToMany(Equipment::class);
    }

    public function sources()
    {
        return $this->belongsToMany(Source::class);
    }

    public function latestSource()
    {
        return $this->belongsToMany(Source::class)->latest('date_in');
    }
}
