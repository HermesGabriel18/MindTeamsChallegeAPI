<?php

namespace App\Models;

use App\Interfaces\HasDisabledInterface;
use App\Interfaces\HasNameInterface;
use App\Traits\Filterable;
use App\Traits\HasDisabled;
use App\Traits\HasName;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model implements
    HasDisabledInterface,
    HasNameInterface
{
    use Filterable,
        HasDisabled,
        HasFactory,
        HasName;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name'
    ];

    protected static function boot()
    {
        parent::boot();
    }
}
