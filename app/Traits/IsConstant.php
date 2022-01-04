<?php

namespace App\Traits;

use Illuminate\Support\Str;
use ReflectionClass;

trait IsConstant
{

    /**
     * Appends getLabelAttribute method
     */
    public function initializeIsConstant()
    {
        $this->appends[] = 'label';
    }

    /**
     * @return string
     */
    public function getLabelAttribute(): string
    {
        if (! $this->getRawOriginal('name')) {
            return '';
        }

        return $this->getLabel();
    }

    /**
     * @return string
     */
    public function getLabel(): string
    {
        return tName($this);
    }

    /**
     * @return array
     */
    public static function getConstants(): array
    {
        return collect((new ReflectionClass(self::class))->getConstants())
            ->filter(fn ($id, $name) => ! in_array($name, ['CREATED_AT', 'UPDATED_AT']) && is_numeric($id))
            ->toArray();
    }

    /**
     * @return string
     */
    public function getConstantKey(): string
    {
        return Str::lower(Str::plural(Str::snake(class_basename($this))));
    }

}
