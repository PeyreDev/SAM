<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cvr_step extends Model
{
    use HasFactory;

    protected $fillable = [
        'pressure',
        'duration',
        'temperature_initial',
        'temperature_final',
        'cvr_id',
    ];

    public $timestamps = false;

    public function gasFlows()
    {
        return $this->hasMany(Gas_flow::class);
    }

    public function Cvr()
    {
        return $this->belongsTo(Cvr::class, 'cvr_id');
    }

    public function documents()
    {
        return $this->morphMany(Document::class, 'related');
    }

    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }

    public function latestTag()
    {
        return $this->morphToMany(Tag::class, 'taggable')
            ->latest();
    }
}
