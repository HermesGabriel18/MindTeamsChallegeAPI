<?php

namespace App\Repositories;

use App\Models\Project;

class ProjectRepository
{
    /**
     * @param array $data
     * @return Project
     */
    public function create(array $data): Project
    {
        $project = Project::make($data);
        $project->client_id = data_get($data, 'client_id');
        $project->save();

        return $project;
    }

    /**
     * @param Project $project
     * @param array $data
     * @return Project
     */
    public function update(Project $project, array $data): Project
    {
        $project->update($data);

        return $project;
    }
}
