<?php

namespace App\Traits;

trait HasDisabled
{
    public function initializeHasDisabled()
    {
        $this->casts += ['disabled' => 'date'];
    }

    /**
     * @return bool
     */
    public function isDisabled() : bool
    {
        return (bool) $this->disabled;
    }

    /**
     * @return bool
     */
    public function toggleDisabled() : bool
    {
        $this->forceFill(['disabled' => $this->disabled ? null : now()])->save();

        return ! ! $this->disabled;
    }
}
