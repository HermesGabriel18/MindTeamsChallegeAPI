<?php

namespace App\Interfaces;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

interface HasCreatedByInterface
{
    /**
     * @return BelongsTo
     */
    public function createdBy();
}
