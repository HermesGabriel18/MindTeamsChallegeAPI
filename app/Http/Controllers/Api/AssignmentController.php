<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\AssignmentRequest;
use App\Http\Resources\AssignmentResource;
use App\Models\Assignment;
use App\Repositories\AssignmentRepository;
use Illuminate\Http\JsonResponse;

class AssignmentController extends Controller
{
    /**
     * Get Assignment list.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $assignment = Assignment::filter(request()->all())
            ->getOrPaginate();

        return $this->indexResponse(AssignmentResource::collection($assignment));
    }

    /**
     * Display the specified Assignment.
     * 
     * @param Assignment $assignment
     *
     * @return JsonResponse
     */
    public function show(Assignment $assignment): JsonResponse
    {
        return $this->showResponse(new AssignmentResource($assignment));
    }

    /**
     * Store a newly created Assignment in storage.
     * 
     * @param AssignmentRequest $request
     * @param AssignmentRepository $assignmentRepository
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function store(AssignmentRequest $request, AssignmentRepository $assignmentRepository): JsonResponse
    {
        $assignment = $assignmentRepository->create($request->validated());

        return $this->storeResponse(new AssignmentResource($assignment));
    }

    /**
     * Remove the specified Assignment from storage.
     * 
     * @param Assignment $assignment
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function destroy(Assignment $assignment): JsonResponse
    {
        $this->destroyModel($assignment);

        return $this->destroyResponse(new AssignmentResource($assignment));
    }
}
