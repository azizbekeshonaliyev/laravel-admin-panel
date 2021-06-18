<?php

namespace Domain\Partner\Entities;

use App\Domain\Core\Entities\Entity;

class PartnerTranslation extends Entity
{
    public $timestamps = false;

    protected $fillable = ['name', 'desc', 'locale', 'partner_id'];
}
