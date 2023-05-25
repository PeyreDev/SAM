<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Substrate extends Model
{
    use HasFactory;

    protected $fillable = [
        'position',
        'face',
        'substrate_batch_id',
    ];

    public $timestamps = false;

    public function processStep()
    {
        return $this->morphOne(Process_step::class, 'related');
    }

    public function substrateBatch()
    {
        return $this->belongsTo(Substrate_batch::class, 'substrate_batch_id');
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
