<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    /**
     * Get Users list.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $users = User::filter(request()->all())
            ->getOrPaginate();

        return $this->indexResponse(UserResource::collection($users));
    }

    /**
     * Display the specified User.
     * 
     * @param User $user
     *
     * @return JsonResponse
     */
    public function show(User $user): JsonResponse
    {
        return $this->showResponse(new UserResource($user));
    }

    /**
     * Store a newly created User in storage.
     * 
     * @param UserRequest $request
     * @param UserRepository $userRepository
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function store(UserRequest $request, UserRepository $userRepository): JsonResponse
    {
        $user = $userRepository->create($request->validated());

        return $this->storeResponse(new UserResource($user));
    }

    /**
     * Update the specified User in storage.
     * 
     * @param UserRequest $request
     * @param User $user
     * @param UserRepository $userRepository
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function update(UserRequest $request, User $user, UserRepository $userRepository): JsonResponse
    {
        $user = $userRepository->update($user, $request->validated());

        return $this->updateResponse(new UserResource($user));
    }

    /**
     * Remove the specified User from storage.
     * 
     * @param User $user
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function destroy(User $user): JsonResponse
    {
        $this->destroyModel($user);

        return $this->destroyResponse(new UserResource($user));
    }
}
