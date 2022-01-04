<?php

namespace App\Interfaces;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\MorphMany;

interface HasNameInterface
{
    /**
     * @param $value
     * @return string
     */
    public function getNameAttribute($value);

    /**
     * @param $value
     */
    public function setNameAttribute($value);
}
