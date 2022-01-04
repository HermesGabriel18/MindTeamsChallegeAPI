<?php

namespace App\Http\Resources;

use App\Services\ConstantsService;

class UserResource extends ApiResource
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
            'role_id' => $this->role_id,
            'name' => $this->name,
            'email' => $this->email,
            'email_verified_at' => optional($this->email_verified_at)->toDateTimeString(),
            'locale' => $this->locale,
            'disabled' => optional($this->disabled)->toDateString(),
            'role' => ConstantsService::toResource($this->resource, 'role')
        ];
    }
}
