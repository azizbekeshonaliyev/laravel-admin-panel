<?php

namespace Domain\Language\Entities;

use Illuminate\Database\Eloquent\Model;

class Translation extends Model
{
    protected $fillable = ['locale', 'key', 'value'];
}
