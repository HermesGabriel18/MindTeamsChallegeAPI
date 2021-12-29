<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

trait HasName
{
    /**
     * @param $value
     * @return string|null
     */
    public function getNameAttribute($value): ?string
    {
        return $value
            ? Str::title($value)
            : null;
    }

    /**
     * @param $value
     */
    public function setNameAttribute($value)
    {
        if (!$value) {
            return;
        }
        $this->attributes['name'] = Str::of($value)
            ->replace('.', '')
            ->replace(',', '')
            ->replace(':', '')
            ->trim()
            ->title()
            ->__toString();
    }

    /**
     * @param Builder $builder
     * @param string $name
     * @return Builder
     */
    public function scopeByName(Builder $builder, string $name): Builder
    {
        return $builder->where(function (Builder $q) use ($name) {
            $q->where('name', 'like', "%$name%");
        });
    }
}
