<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ConstantResource;
use App\Models\Role;
use Illuminate\Http\JsonResponse;

class RoleController extends Controller
{
    /**
     * Display a listing of all roles.
     *
     * @return JsonResponse
     * @throws Exception
     */
    public function index(): JsonResponse
    {
        $roles = Role::get();

        return $this->dataResponse('index', ConstantResource::collection($roles));
    }
}