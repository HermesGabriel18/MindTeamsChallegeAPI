<?php

namespace App\Rules;

use App\Models\Assignment;
use App\Models\Role;
use App\Models\User;
use Illuminate\Contracts\Validation\Rule;

class AssignmentRule implements Rule
{
    const MAX_ASSIGNMENTS = 2; // Max assignments per user.
    const MAX_ASSIGNMENTS_MESSAGE = 'max_assignments';
    const ALREADY_ASSIGNED = 'already_assigned';
    const MUST_BE_REGULAR_MESSAGE = 'must_be_regular';

    private string $value;
    private string $attribute;
    private string $project_id;

     /**
     * Create a new rule instance.
     *
     * @param int $project_id
     */
    public function __construct($project_id)
    {
        $this->project_id = $project_id;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param string $attribute
     * @param mixed $value
     * @return bool
     */
    public function passes($attribute, $value): bool
    {
        if (!$value) {
            return true;
        }

        $this->attribute = $attribute;
        $this->value = $value;

        $user = User::where('id', $this->value)->first();

        if(!hasRole(Role::REGULAR, false, $user)) {
            $this->message = self::MUST_BE_REGULAR_MESSAGE;
            return false;
        }

        $assignments = Assignment::where($this->attribute, $this->value)
            ->where('project_id', $this->project_id)->count();

        if($assignments > 0) {
            $this->message = self::ALREADY_ASSIGNED;
            return false;
        }

        $assignments = Assignment::where($this->attribute, $this->value)->count();
        $this->message = self::MAX_ASSIGNMENTS_MESSAGE;

        return $assignments < self::MAX_ASSIGNMENTS;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message(): string
    {
        $attribute = tValidation($this->attribute);

        return "$attribute " . tCustomValidation($this->attribute, $this->message);
    }
}
