<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\DB;

class NotDisabledRule implements Rule
{
    private string $table;
    private string $column;
    private string $value;
    private string $attribute;

    /**
     * Create a new rule instance.
     *
     * @param string $table
     * @param string $column
     */
    public function __construct(string $table, string $column = 'id')
    {
        $this->table = $table;
        $this->column = $column;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $this->attribute = $attribute;
        $this->value = $value;

        return DB::table($this->table)
            ->where($this->column, $this->value)
            ->whereNull('disabled')
            ->exists();
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        $attribute = tValidation($this->attribute);

        return "$attribute " . tValidation('disabled');
    }
}
