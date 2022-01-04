<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

abstract class BaseFormRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    abstract public function rules();

    /**
     * @param string $key
     * @param string $requestClass
     * @param bool $required
     * @param array $rulesData
     * @return array
     */
    public function nestedRules(string $key, string $requestClass, $required = false, array $rulesData = [])
    {
        return $this->buildRules($key, $requestClass, $required, $rulesData);
    }

    /**
     * @param string $name
     * @param string $requestClass
     * @param bool $required
     * @param array $rulesData
     * @return array
     */
    public function nestedArrayRules(string $name, string $requestClass, $required = false, array $rulesData = [])
    {
        return $this->buildRules($name, $requestClass, $required, $rulesData, true);
    }

    /**
     * @param string $name
     * @param string $requestClass
     * @param bool $required
     * @param array $rulesData
     * @param bool $isArray
     * @return array
     */
    private function buildRules(string $name, string $requestClass, bool $required = false, array $rulesData = [], bool $isArray = false)
    {
        $baseRule = $this->buildBaseRule($name, $required, $isArray);

        $data = $this->all()[$name] ?? [];

        if (! $data) {
            return $baseRule;
        }

        $data = $this->all()[$name];

        if (! is_array($data)) {
            return $baseRule;
        }

        $request = new $requestClass($data, $data);
        $request->setMethod($this->getMethod());

        $rules = array_merge($request->rules(), $rulesData);

        return $baseRule + collect($rules)
                ->mapWithKeys(fn ($rule, $ruleKey) => [$isArray ? "$name.*.$ruleKey" : "$name.$ruleKey" => $rule])
                ->toArray();
    }

    /**
     * @param bool $required
     * @param string $name
     * @param bool $isArray
     * @return array|string[]
     */
    private function buildBaseRule(string $name, bool $required, bool $isArray = false)
    {
        if (! $required) {
            return [$name => 'nullable|array'];
        }

        $rule = [$name => 'required|array'];

        if ($isArray) {
            $rule["$name.*"] = 'array';
        }

        return $rule;
    }
}
