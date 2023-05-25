<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Process_step extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'related_type',
        'related_id',
        'user_id',
    ];

    public $timestamps = false;

    public function samples()
    {
        return $this->belongsToMany(Sample::class);
    }

    public function related()
    {
        return $this->morphTo();
    }

    public function equipments()
    {
        return $this->belongsToMany(Equipment::class);
    }

    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }
}
