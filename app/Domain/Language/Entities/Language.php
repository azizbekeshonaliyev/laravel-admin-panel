<?php

namespace Domain\Language\Entities;

use App\Models\Auth\User;
use App\Domain\Core\Entities\Entity;

class Language extends Entity
{
    protected $fillable = ['name', 'locale', 'active', 'rank', 'created_by'];

    protected $casts = [
        'active' => 'boolean',
    ];

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function scopeActive($query, $active = true)
    {
        return $query->where('active', $active);
    }
}
