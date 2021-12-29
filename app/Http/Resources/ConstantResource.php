<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;

class ConstantResource extends ApiResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request
     *
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'class_name' => $this->getClassName(),
            'name' => $this->name,
            'label' => $this->getLabel(),
        ];
    }
}
