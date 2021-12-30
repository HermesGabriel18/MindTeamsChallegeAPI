<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;

class AssignmentFilter extends Filter
{
    /**
     * @param $id
     *
     * @return Builder
     */
    protected function userId($id): Builder
    {
        return $this->builder->where('user_id', $id);
    }

    /**
     * @param $id
     *
     * @return Builder
     */
    protected function projectId($id): Builder
    {
        return $this->builder->where('project_id', $id);
    }

}
