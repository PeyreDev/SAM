<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    public $timestamps = false;

    public function tagCat()
    {
        return $this->belongsTo(Tagcat::class, 'tagcat_id');
    }

    public function externalSamples()
    {
        return $this->morphedByMany(External_sample::class, 'taggable');
    }

    public function substrateBatches()
    {
        return $this->morphedByMany(Substrate_batch::class, 'taggable');
    }

    public function documents()
    {
        return $this->morphedByMany(Document::class, 'taggable');
    }

    public function samples()
    {
        return $this->morphedByMany(Sample::class, 'taggable');
    }

    public function substrates()
    {
        return $this->morphedByMany(Substrate::class, 'taggable');
    }

    public function cvrs()
    {
        return $this->morphedByMany(Cvr::class, 'taggable');
    }

    public function cvrSteps()
    {
        return $this->morphedByMany(Cvr_step::class, 'taggable');
    }

    public function splits()
    {
        return $this->morphedByMany(Split::class, 'taggable');
    }

    public function equipments()
    {
        return $this->morphedByMany(Equipment::class, 'taggable');
    }

    public function cleanings()
    {
        return $this->morphedByMany(Cleaning::class, 'taggable');
    }
}
