<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;

class TransactionFilter extends Filter
{

    /**
     * @param $id
     *
     * @return Builder
     */
    protected function transactionTypeId($id): Builder
    {
        return $this->builder->where('transaction_type_id', $id);
    }

     /**
     * @param $ids
     *
     * @return Builder
     */
    protected function transactionTypeIds($ids): Builder
    {
        return $this->builder->whereIn('transaction_type_id', $ids);
    }

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
