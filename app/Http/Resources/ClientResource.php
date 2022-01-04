<?php

namespace App\Http\Resources;

class ClientResource extends ApiResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'class_name' => $this->getClassName(),
            'name' => $this->name,
            'disabled' => optional($this->disabled)->toDateString()
        ];
    }
}
