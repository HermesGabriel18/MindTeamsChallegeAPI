<?php

namespace App\Http\Resources;

use App\Http\Resources\ClientResource;

class ProjectResource extends ApiResource
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
            'client_id' => $this->client_id,
            'name' => $this->name,
            'disabled' => optional($this->disabled)->toDateString(),
            'deleted_at' => $this->when($this->deleted_at, optional($this->deleted_at)->toDateString()),
            'client' => $this->when($this->client_id, new ClientResource($this->whenLoaded('client')))
        ];
    }
}
