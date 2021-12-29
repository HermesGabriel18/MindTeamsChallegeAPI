<?php

namespace App\Interfaces;

interface HasDisabledInterface
{
    /**
     * @return bool
     */
    public function isDisabled() : bool;

    /**
     * @return bool
     */
    public function toggleDisabled() : bool;
}
