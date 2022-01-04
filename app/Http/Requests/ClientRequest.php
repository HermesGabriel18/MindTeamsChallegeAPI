<?php

namespace App\Http\Requests;

use App\Rules\NameRule;

/**
 * Class ClientRequest
 * @package App\Http\Requests
 */
class ClientRequest extends BaseFormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255', new NameRule()]
        ];
    }
}
