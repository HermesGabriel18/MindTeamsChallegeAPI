<?php

namespace App\Models;

use App\Interfaces\IsConstantInterface;
use App\Traits\IsConstant;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TransactionType extends Model implements IsConstantInterface
{
    use IsConstant;

    const ADDED = 1;
    const REMOVED = 2;

    // /**
    //  * @return HasMany
    //  */
    // public function transactions(): HasMany
    // {
    //     return $this->hasMany(Transaction::class);
    // }
}
