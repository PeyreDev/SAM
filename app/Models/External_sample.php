<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class External_sample extends Model
{
    use HasFactory;

    protected $fillable = [
        'origin',
    ];

    public $timestamps = false;

    public function processStep()
    {
        return $this->morphOne(Process_step::class, 'related');
    }

    public function documents()
    {
        return $this->morphMany(Document::class, 'related');
    }

    public function tagable()
    {
        return $this->morphOne(Tagable::class, 'related');
    }

    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }
}
