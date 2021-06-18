<?php

namespace Domain\Topic\Entities;

use App\Domain\Core\Entities\Entity;

class TopicTranslation extends Entity
{
    public $timestamps = false;

    protected $fillable = ['title', 'desc', 'locale', 'topic_id', 'meta_title', 'meta_description', 'meta_keywords'];
}
