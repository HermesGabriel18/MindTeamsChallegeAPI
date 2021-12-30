<?php

namespace App\Http\Resources;

use App\Http\Resources\UserResource;
use App\Http\Resources\ProjectResource;

class AssignmentResource extends ApiResource
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
            'user_id' => $this->user_id,
            'project_id' => $this->project_id,
            'deleted_at' => $this->when($this->deleted_at, optional($this->deleted_at)->toDateString()),
            'user' => $this->when($this->user_id, new UserResource($this->whenLoaded('user'))),
            'project' => $this->when($this->project_id, new ProjectResource($this->whenLoaded('project')))
        ];
    }
}
