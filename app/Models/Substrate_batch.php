<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Substrate_batch extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'initial_quantity',
        'user_id',
        'remaining_quantity',
        'name',
        'provider',
        'material',
        'thickness',
        'resistivity',
        'orientation',
        'miscut',
        'element_size',
        'doping',
        'doping_type',
        'doping_element',
        'comment',
        'mapping',
    ];

    public function substrates()
    {
        return $this->hasMany(Substrate::class);
    }

    public function documents()
    {
        return $this->morphMany(Document::class, 'related');
    }

    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }

    public function tagMaterial()
    {
        return $this->belongsTo(Tag::class, 'material');
    }

    public function tagOrientation()
    {
        return $this->belongsTo(Tag::class, 'orientation');
    }
}
