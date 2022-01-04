<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;

class ProjectFilter extends Filter
{
    /**
     * @param $id
     *
     * @return Builder
     */
    protected function clientId($id): Builder
    {
        return $this->builder->where('client_id', $id);
    }

}
