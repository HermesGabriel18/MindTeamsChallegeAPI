<?php

namespace App\Http\Resources;

use App\Interfaces\HasCreatedByInterface;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\MergeValue;
use Illuminate\Http\Resources\MissingValue;
use Illuminate\Support\Str;

class ApiResource extends JsonResource
{
    /**
     * It add createdBy relation shio
     * If the model has a n:m relationship, for example, like $user->roles
     * then it will add a roles_count attribute to the Resource
     *
     * @return MergeValue|MissingValue
     */
    public function addCreatedBy()
    {
        /** @var Model $model */
        $model = $this->resource;

        if ($model instanceof HasCreatedByInterface) {
            return new MergeValue([
                'createdBy' => new UserResource($this->whenLoaded('createdBy')),
                'created_by' => $model->created_by,
            ]);
        }

        return new MissingValue();
    }

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
