<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Str;

class ApiResource extends JsonResource
{
    /**
     * @return string
     */
    public function getClassName(): string
    {
        return Str::of(class_basename($this->resource))
            ->lower()
            ->trim()->
            __toString();
    }
}
