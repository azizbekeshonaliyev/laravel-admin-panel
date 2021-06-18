<?php

namespace Domain\Topic\Entities;

use Carbon\Carbon;
use App\Models\Auth\User;
use Bek96\Album\Traits\HasAlbum;
use App\Domain\Core\Entities\Entity;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;

class Topic extends Entity implements TranslatableContract
{
    use SoftDeletes, Translatable, HasAlbum;

    protected $fillable = ['published_at', 'rank', 'active', 'created_by', 'updated_by'];

    public $translatedAttributes = ['title', 'desc', 'meta_title', 'meta_description', 'meta_keywords'];

    protected $casts = [
        'active' => 'boolean',
    ];

    public function scopeActive($query, $active = true)
    {
        return $query->where('active', $active);
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    public function getPublishedAtAttribute()
    {
        return $this->attributes['published_at'] ? date('d.m.Y', strtotime($this->attributes['published_at'])) : '';
    }
}
