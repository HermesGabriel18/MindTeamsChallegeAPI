<?php

namespace App\Services;

use App\Interfaces\IsConstantInterface;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Resources\MissingValue;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use ReflectionClass;
use ReflectionException;

class ConstantsService
{
    public static int $DAY = 86400; // 86400 seconds = 1 day

    /**
     * @return array
     * @throws Exception
     */
    public function getConstants(): array
    {
        $locale = app()->getLocale();
        return cache()->remember("constants-$locale", self::$DAY, function () {
            return $this->loadModels()
                ->mapWithKeys(function ($constant) {
                    $data = $constant->all()->map(fn ($constant) => self::toArray($constant));

                    return [$constant->getConstantKey() => $data];
                })
                ->toArray();
        });
    }

    /**
     * @param bool $onlyConstants
     * @return Collection
     */
    public function loadModels(?bool $onlyConstants = true): Collection
    {
        return collect(glob(app_path('Models') . '/*.php'))
            ->each(fn ($file) => require_once $file)
            ->map(fn ($filePath) => 'App\\Models\\' . basename($filePath, '.php'))
            ->filter(fn ($class) => $this->isConstant($class, $onlyConstants))
            ->map(fn ($modelString) => resolve($modelString));
    }

    /**
     * @param $class
     * @param bool $isConstant
     * @return bool
     * @throws ReflectionException
     */
    private function isConstant($class, ?bool $isConstant = true): bool
    {
        $reflection = new ReflectionClass($class);

        if (! $isConstant) {
            return ! $reflection->implementsInterface(IsConstantInterface::class);
        }

        return $reflection->implementsInterface(IsConstantInterface::class);
    }

    /**
     * @return int
     */
    public function seed(): int
    {
        return $this->loadModels()
            ->map(fn (IsConstantInterface $model) => count($this->seedConstant($model) ?? []))
            ->filter()
            ->count();
    }

    /**
     * @param IsConstantInterface|Model $model
     * @return array|null
     */
    public function seedConstant(IsConstantInterface $model): ?array
    {
        try {
            return collect($model->getConstants())
                ->mapWithKeys(fn ($id, $name) => [$id => Str::snake(Str::lower($name))])
                ->map(
                    function ($name, $id) use ($model) {
                        $model::unguard();

                        if (method_exists($model, 'getData')) {
                            $data =  $model->getData($id);
                        } else {
                            $data = [
                                'id' => $id,
                                'name' => $name
                            ];
                        }

                        if (method_exists($model, 'trashed')) {
                            $model->withTrashed()->updateOrCreate(['id' => $id], $data);
                        } else {
                            $model::updateOrCreate(['id' => $id], $data);
                        }

                        $model::reguard();
                        return $model;
                    }
                )->toArray();
        } catch (Exception $e) {
            error_log($e->getMessage());
            return null;
        }
    }

    /**
     * @param Model|null $model
     * @return array|MissingValue
     */
    public static function toArray(?Model $model = null): array|MissingValue
    {
        if (! $model) {
            return new MissingValue();
        }

        return [
            'id' => $model->id,
            'name' => $model->name,
            'label' => $model->label
        ];
    }

    /**
     * @param Model $model
     * @param string $relationship
     * @return array|MissingValue
     */
    public static function toResource(Model $model, string $relationship): array|MissingValue
    {
        if (! $model->relationLoaded($relationship)) {
            return new MissingValue();
        }

        $relation = $model->$relationship;

        if ($relation instanceof Collection) {
            return $relation
                ->map(fn (Model $constant) => self::toArray($constant))
                ->toArray();
        }

        return self::toArray($model->$relationship);
    }
}
