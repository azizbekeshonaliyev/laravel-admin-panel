<?php

namespace Domain\Catalog\Entities;

use App\Models\Auth\User;
use Bek96\Album\Traits\HasAlbum;
use App\Domain\Core\Entities\Entity;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;

class Product extends Entity implements TranslatableContract
{
    use SoftDeletes, Translatable, HasAlbum;

    protected $fillable = [
        'catalog_category_id',
        'price',
        'in_stock',
        'active',
        'rank',
        'created_by',
        'updated_by',
    ];

    protected $casts = [
        'price' => 'float',
        'in_stock' => 'float',
        'active' => 'boolean',
        'rank' => 'integer',
    ];

    public $translatedAttributes = ['name', 'desc', 'meta_title', 'meta_description', 'meta_keywords'];

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

    public function category()
    {
        return $this->belongsTo(CatalogCategory::class, 'catalog_category_id');
    }
}
