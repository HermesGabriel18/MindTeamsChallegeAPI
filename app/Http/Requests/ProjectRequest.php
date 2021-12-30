<?php

namespace App\Http\Requests;

use App\Rules\NameRule;

/**
 * Class ProjectRequest
 * @package App\Http\Requests
 */
class ProjectRequest extends BaseFormRequest
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
        if ($this->isMethod('post')) {
            return [
                'client_id' => 'required|exists:clients,id',
                'name' => ['required', 'string', 'max:255', new NameRule()]
            ];
        } else {
            return [
                'name' => ['string', 'max:255', new NameRule()]
            ];
        }
    }
}
