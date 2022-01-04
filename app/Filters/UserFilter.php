<?php

namespace App\Filters;

use App\Models\Role;
use Illuminate\Database\Eloquent\Builder;

class UserFilter extends Filter
{
    /**
     * @param string $email
     *
     * @return Builder
     */
    protected function email($email): Builder
    {
        return $this->builder->where('email', 'like', "%$email%");
    }

    /**
     * @param $id
     *
     * @return Builder
     */
    protected function roleId($id): Builder
    {
        return $this->builder->where('role_id', $id);
    }

    /**
     * @param $ids
     * @return Builder
     */
    protected function roleIds($ids): Builder
    {
        return $this->builder->whereIn('role_id', $ids);
    }

    /**
     * @param $value
     * @return Builder
     */
    protected function internals($value): Builder
    {
        if ($value) {
            return $this->builder->whereIn('role_id', Role::INTERNALS);
        }

        return $this->builder->whereNotIn('role_id', Role::INTERNALS);
    }

    /**
     * @param bool $verified
     * @return Builder
     */
    protected function verified(bool $verified): Builder
    {
        return $this->filterNullable('email_verified_at', $verified);
    }
}
