<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Repositories\UserRepository;
use App\Rules\NotDisabledRule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{

    protected bool $onlyAction = true;
    protected string $modelName = 'user';

     /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    private UserRepository $userRepository;

    /**
     * Create a new controller instance.
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        parent::__construct();
        $this->userRepository = $userRepository;
    }

     /**
     * Login into the application.
     * After a successful Login, you will receive a token in response.
     * Use the given token in every request as an Authorization header
     *
     * @param Request $request
     * @return JsonResponse
     * @throws ValidationException
     */
    public function login(Request $request): JsonResponse
    {
        $request->validate([
            'email' => ['required',
                'string',
                'email',
                'exists:users,email',
                new NotDisabledRule('users', 'email')],
            'password' => 'required|string',
        ]);

        if (!Auth::attempt($request->only('email', 'password'))) {
            throw ValidationException::withMessages([
                'email' => [trans('auth.failed')],
            ]);
        }

        $user = $this->userRepository->loadRelations(auth()->user());

        $data = new UserResource($user);

        return $this->dataResponse($this->buildMessage('logged'), $data, Response::HTTP_OK);
    }
}
