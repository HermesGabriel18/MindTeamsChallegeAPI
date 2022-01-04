<?php

namespace App\Models;

use App\Interfaces\IsConstantInterface;
use App\Traits\IsConstant;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Role extends Model implements IsConstantInterface
{
    use IsConstant;

    const SUPER_ADMIN = 1;
    const ADMIN = 2;
    const REGULAR = 3;

    const INTERNALS = [
        self::SUPER_ADMIN,
        self::ADMIN,
    ];

    const EXTERNALS = [
        self::REGULAR
    ];

    /**
     * @return HasMany
     */
    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }
}
