<?php

namespace Domain\Certificate\Entities;

use App\Domain\Core\Entities\Entity;

class CertificateTranslation extends Entity
{
    public $timestamps = false;

    protected $fillable = ['name', 'desc', 'locale', 'certificate_id'];
}
