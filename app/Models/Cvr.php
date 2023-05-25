<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cvr extends Model
{
    use HasFactory;

    protected $fillable = [
        'recipe_name',
        'position',
        'equipment_id',
        'comment',
        'motivation',
    ];

    public $timestamps = false;

    public function processStep()
    {
        return $this->morphOne(Process_step::class, 'related');
    }

    public function cvrSteps()
    {
        return $this->hasMany(Cvr_step::class);
    }

    public function documents()
    {
        return $this->morphMany(Document::class, 'related');
    }

    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }

    public function gasFlows()
    {
        return $this->hasManyThrough(
            Gas_flow::class,
            Cvr_step::class,
            'cvr_id',
            'cvr_step_id',
            'id',
            'id'
        );
    }
}
