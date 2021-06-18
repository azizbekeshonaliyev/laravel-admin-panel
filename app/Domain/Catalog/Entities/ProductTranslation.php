<?php

namespace Domain\Catalog\Entities;

use Illuminate\Database\Eloquent\Model;

class ProductTranslation extends Model
{
    public $timestamps = false;

    protected $fillable = ['name', 'desc', 'locale', 'meta_title', 'meta_description', 'meta_keywords'];
}
