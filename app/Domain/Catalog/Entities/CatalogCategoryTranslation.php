<?php

namespace Domain\Catalog\Entities;

use App\Domain\Core\Entities\Entity;

class CatalogCategoryTranslation extends Entity
{
    public $timestamps = false;

    protected $fillable = ['name', 'desc', 'locale'];
}
