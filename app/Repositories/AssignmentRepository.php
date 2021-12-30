<?php

namespace App\Repositories;

use App\Models\Assignment;

class AssignmentRepository
{
    /**
     * @param array $data
     * @return Assignment
     */
    public function create(array $data): Assignment
    {
        $assignment = Assignment::make($data);
        $assignment->user_id = data_get($data, 'user_id');
        $assignment->project_id = data_get($data, 'project_id');
        $assignment->save();

        return $assignment;
    }

}
