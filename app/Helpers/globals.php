<?php

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

/**
 * Used by Controller that manage Polymorphic models (as Disabled) when face 'update' method.
 * This route has the form as '<type>/<id>/model'. So, this method helps to determine the class name of the model
 * by the <type> passed in the url.
 *
 * @param string $type
 *
 * @return string string
 */
function classByString(string $type): string
{
    return Str::of($type)
        ->singular()
        ->studly()
        ->start('App\\Models\\')
        ->__toString();
}


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
 * Translate given attribute name
 *
 * @param $attribute
 * @return string
 */
function tCustomValidation($attribute, $message): string
{
    return trans("validation.custom.$attribute.$message");
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

/**
 * Translate a Model
 *
 * @param string $model
 * @param bool $plural
 * @return string
 */
function modelTitle(string $model, $plural = false): string
{
    $modelName = Str::snake(class_basename($model));

    return trans_choice("models.$modelName.$modelName", $plural ? 2 : 1);
}

if (!function_exists('hasRole')) {
    /**
     * Helper function to know if User has a specific Role.
     *
     * @param int $roleId
     * @param bool $strict
     * @param User|null $user
     *
     * @return bool
     */
    function hasRole(int $roleId, bool $strict = false, User $user = null): bool
    {
        $user = $user ?? auth()->user();

        if (!$user) {
            return false;
        }

        if ($user->role_id === Role::ADMIN && !$strict) {
            return true;
        }

        return $user->role_id === $roleId;
    }
}

if (!function_exists('hasRoles')) {
    /**
     * Helper function to know if User has some specific Role.
     *
     * @param array $roleIds
     * @param bool $strict
     * @param User|null $user
     *
     * @return bool
     */
    function hasRoles(array $roleIds, bool $strict = false, User $user = null): bool
    {
        return collect($roleIds)
            ->some(fn (int $roleId) => hasRole($roleId, $strict, $user));
    }
}

if (!function_exists('hasGroup')) {
    /**
     * @param array $group
     * @param bool $strict
     * @param User|null $user
     * @return bool
     */
    function hasGroup(array $group, bool $strict = false, User $user = null): bool
    {
        $user = $user ?? auth()->user();

        if (!$user) {
            return false;
        }

        if ($user->role_id === Role::ADMIN && !$strict) {
            return true;
        }

        return in_array($user->role_id, $group);
    }
}

/**
 * Dates must be always have formats 'Y-m-d' or 'Y/m/d'
 * @param $value
 * @return bool
 */
function isDateString($value): bool
{
    return $value
        && !is_numeric($value)
        && (substr_count($value, '-') === 2 || substr_count($value, '/') === 2);
}