<?php

namespace App\Http\Requests;

use App\Rules\AssignmentRule;
/**
 * Class ProjectRequest
 * @package App\Http\Requests
 */
class AssignmentRequest extends BaseFormRequest
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
            'user_id' => ['required', 'exists:users,id', new AssignmentRule()],
            'project_id' => 'required|exists:projects,id',
        ];
    
    }
}
