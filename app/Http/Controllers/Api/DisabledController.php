<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Traits\HasDisabled;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class RestoreController
 * @group Restore
 * @package App\Http\Controllers
 */
class DisabledController extends Controller
{
    protected bool $onlyAction = true;

    /**
     * Restore the specified Resource, if possible.
     *
     * @param string $model
     * @param int $id
     * @return JsonResponse
     */
    public function update(string $model, int $id)
    {
        $model = resolve(classByString($model));

        if (! $this->hasDisabled($model)) {
            return $this->emptyResponse();
        }

        $model = $model::findOrFail($id);

        $model->toggleDisabled();

        return $this->updateResponse($this->getResource($model));
    }

    /**
     * @param Model $model
     * @return bool
     */
    private function hasDisabled(Model $model)
    {
        return in_array(HasDisabled::class, class_uses($model));
    }

    /**
     * @param Model $model
     * @return JsonResource
     */
    private function getResource(Model $model)
    {
        $resourceClass = 'App\\Http\\Resources\\' . class_basename($model) . 'Resource';

        return new $resourceClass($model);
    }
}
