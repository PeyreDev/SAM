<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Split extends Model
{
    use HasFactory;

    public $timestamps = false;

    public function processStep()
    {
        return $this->morphOne(Process_step::class, 'related');
    }

    public function documents()
    {
        return $this->morphMany(Document::class, 'related');
    }

    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }
}
