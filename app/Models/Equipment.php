<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipment extends Model
{
    use HasFactory;

    protected $fillable = [
        'supplier',
        'model',
        'serial',
        'out_date',
        'equipment_type',
    ];

    public $timestamps = false;

    protected $table = 'equipments';

    public function localisations()
    {
        return $this->morphMany(Localisation::class,'related');
    }

    public function maintenances()
    {
        return $this->hasMany(Maintenance::class);
    }

    public function latestMaintenance()
    {
        return $this->hasOne(Maintenance::class)->latest('date');
    }

    public function gasLines()
    {
        return $this->belongsToMany(Gas_line::class);
    }

    public function processSteps()
    {
        return $this->belongsToMany(Process_step::class);
    }

    public function documents()
    {
        return $this->morphMany(Document::class, 'related');
    }

    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }

    public function latestLocalisation()
    {
        return $this->hasOne(Localisation::class, 'related_id')
            ->where('related_type','=','App\Models\Equipment')
            ->latest('date_in');
    }
}
