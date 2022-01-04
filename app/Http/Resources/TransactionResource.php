<?php

namespace App\Http\Resources;

use App\Http\Resources\ProjectResource;
use App\Http\Resources\UserResource;
use App\Services\ConstantsService;
use Illuminate\Http\Request;

class TransactionResource extends ApiResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request
     *
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'class_name' => $this->getClassName(),
            'transaction_type_id' => $this->transaction_type_id,
            'user_id' => $this->user_id,
            'project_id' => $this->project_id,
            'details' => $this->when($this->details, $this->details),
            'transactionType' => ConstantsService::toResource($this->resource, 'transactionType'),
            'user' => $this->when($this->user_id, new UserResource($this->whenLoaded('user'))),
            'project' => $this->when($this->project_id, new ProjectResource($this->whenLoaded('project'))),
            'createdBy' => new UserResource($this->whenLoaded('createdBy')), $this->addCreatedBy(),
            'created_at' => optional($this->created_at)->toDateTimeString()
        ];
    }
}
