<?php

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

/**
 * Translate given attribute name
 *
 * @param $attribute
 * @return string
 */
function tValidation($attribute): string
{
    return trans("validation.attributes.$attribute");
}

/**
 * Translate a Model name, useful for Constants Models.
 *
 * @param Model|null $model
 * @return string|null
 */
function tName(?Model $model = null): ?string
{
    if (!$model) {
        return null;
    }

    $modelName = Str::snake(class_basename($model));
    $name = Str::lower($model->name);

    return trans("models.$modelName.$name");
}