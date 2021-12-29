<?php

namespace App\Interfaces;

interface IsConstantInterface
{
    /**
     * @return string
     */
    public function getLabel() : string;

    /**
     * @return array
     */
    public static function getConstants() : array;

    /**
     * @return string
     */
    public function getConstantKey() : string;
}
