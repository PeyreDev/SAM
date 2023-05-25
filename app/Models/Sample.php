<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sample extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'size',
        'parent_position',
        'parent_id',
        'available',
        'comment',
    ];

    public $timestamps = false;

    public function processSteps()
    {
        return $this->belongsToMany(Process_step::class);
    }

    public function processStepsDesc()
    {
        return $this->belongsToMany(Process_step::class)
            ->orderBy('date', 'desc');
    }

    public function latestProcessStep()
    {
        return $this->belongsToMany(Process_step::class)
            ->latest('date');
    }

    public function oldestProcessStep()
    {
        return $this->belongsToMany(Process_step::class)
            ->oldest('date');
    }

    public function localisations()
    {
        return $this->morphMany(Localisation::class,'related');
    }

    public function documents()
    {
        return $this->morphMany(Document::class, 'related');
    }

    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }

    public function cvrs()
    {
        return $this->sampleSteps()->where('related_type','=','App\Models\Cvr');
    }

    public function latestLocalisation()
    {
        return $this->hasOne(Localisation::class, 'related_id')
            ->where('related_type','=','App\Models\Sample')
            ->latest('date_in');
    }
}
