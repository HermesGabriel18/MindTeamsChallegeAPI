<?php

namespace App\Http\Requests;

use App\Rules\NameRule;

/**
 * Class UserRequest
 * @package App\Http\Requests
 */
class UserRequest extends BaseFormRequest
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
                'role_id' => 'required|exists:roles,id',
                'name' => ['required', 'string', 'max:255', new NameRule()],
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'nullable|string|min:8|confirmed',
            ];
        } else {
            return [
                'role_id' => 'exists:roles,id',
                'name' => ['string', 'max:255', new NameRule()],
                'locale' => 'string|max:2',
                'password' => 'string|min:8|confirmed',
            ];
        }
    }
}
