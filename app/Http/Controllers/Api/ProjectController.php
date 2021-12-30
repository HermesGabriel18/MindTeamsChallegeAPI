<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProjectRequest;
use App\Http\Resources\ProjectResource;
use App\Models\Project;
use App\Repositories\ProjectRepository;
use Illuminate\Http\JsonResponse;

class ProjectController extends Controller
{
    /**
     * Get Projects list.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $project = Project::filter(request()->all())
            ->getOrPaginate();

        return $this->indexResponse(ProjectResource::collection($project));
    }

    /**
     * Display the specified Project.
     * 
     * @param Project $project
     *
     * @return JsonResponse
     */
    public function show(Project $project): JsonResponse
    {
        return $this->showResponse(new ProjectResource($project));
    }

    /**
     * Store a newly created Project in storage.
     * 
     * @param ProjectRequest $request
     * @param ProjectRepository $projectRepository
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function store(ProjectRequest $request, ProjectRepository $projectRepository): JsonResponse
    {
        $project = $projectRepository->create($request->validated());

        return $this->storeResponse(new ProjectResource($project));
    }

    /**
     * Update the specified Project in storage.
     * 
     * @param ProjectRequest $request
     * @param Project $project
     * @param ProjectRepository $projectRepository
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function update(ProjectRequest $request, Project $project, ProjectRepository $projectRepository): JsonResponse
    {
        $project = $projectRepository->update($project, $request->validated());

        return $this->updateResponse(new ProjectResource($project));
    }

    /**
     * Remove the specified Project from storage.
     * 
     * @param Project $project
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function destroy(Project $project): JsonResponse
    {
        $this->destroyModel($project);

        return $this->destroyResponse(new ProjectResource($project));
    }
}
