<?php

namespace App\Traits;

use App\Interfaces\HasCreatedByInterface;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait HasCreatedBy
{
    public function initializeHasCreatedBy()
    {
        $this->casts += ['created_by' => 'int'];
    }

    public static function bootHasCreatedBy()
    {
        static::creating(function (HasCreatedByInterface $model) {
            $model->created_by = $model->created_by ?? auth()->id();
        });
    }

    /**
     * @return BelongsTo
     */
    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
