<?php

namespace App\Models;

use App\Interfaces\HasDisabledInterface;
use App\Interfaces\HasNameInterface;
use App\Traits\Filterable;
use App\Traits\HasDisabled;
use App\Traits\HasName;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

class Project extends Model implements
    HasDisabledInterface,
    HasNameInterface
{
    use HasDisabled,
        HasFactory,
        HasName,
        Filterable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'client_id',
        'name'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'client_id' => 'int'
    ];

    protected static function boot()
    {
        parent::boot();
    }

    /**
     * @return BelongsTo
     */
    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }
}
