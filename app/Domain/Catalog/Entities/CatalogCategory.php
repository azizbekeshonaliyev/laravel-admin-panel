<?php

namespace Domain\Catalog\Entities;

use App\Models\Auth\User;
use App\Domain\Core\Entities\Entity;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;

class CatalogCategory extends Entity implements TranslatableContract
{
    use Translatable, SoftDeletes;

    protected $fillable = ['parent_id', 'active', 'created_by', 'updated_by'];

    public $translatedAttributes = ['name', 'desc'];

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

    public function parent()
    {
        return $this->belongsTo(self::class, 'parent_id');
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
