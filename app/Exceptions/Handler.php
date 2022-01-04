<?php

namespace App\Exceptions;

use App\Responses\SimpleResponse;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Contracts\Container\Container;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\Eloquent\RelationNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;
use Throwable;

class Handler extends ExceptionHandler
{

    private SimpleResponse $simpleResponse;

    public function __construct(Container $container)
    {
        parent::__construct($container);
        $this->simpleResponse = resolve(SimpleResponse::class);
    }

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<Throwable>>
     */
    protected $dontReport = [
        ValidationException::class,
        AuthenticationException::class,
        ModelNotFoundException::class,
        NotFoundHttpException::class,
        RelationNotFoundException::class,
        AuthorizationException::class,
        UnauthorizedHttpException::class
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

        /**
     * Render an exception into an HTTP response.
     *
     * @param Request $request
     * @param Throwable $e
     *
     * @return JsonResponse|\Symfony\Component\HttpFoundation\Response
     * @throws Throwable
     */
    public function render($request, Throwable $e): JsonResponse|\Symfony\Component\HttpFoundation\Response
    {
        if ($request->expectsJson()) {
            if ($e instanceof ValidationException) {
                return $this->simpleResponse->exception('validation', Response::HTTP_UNPROCESSABLE_ENTITY, $e->validator->getMessageBag()->toArray());
            }

            if ($e instanceof ModelNotFoundException) {
                preg_match('/\[(.+?)\]/', $e->getMessage(), $match);

                if (isset($match[1])) {
                    $model = Str::snake(str_replace('App\\Models\\', '', $match[1]));
                    $result = modelTitle($model);
                } else {
                    $result = $e->getMessage();
                }

                return $this->simpleResponse->exception(trans('exceptions.not_found_data', ['data' => $result]), Response::HTTP_NOT_FOUND);
            }

            if ($e instanceof NotFoundHttpException || $e instanceof FileNotFoundException) {
                return $this->simpleResponse->exception(trans('exceptions.not_found'), Response::HTTP_NOT_FOUND);
            }

            if ($e instanceof RelationNotFoundException) {
                preg_match('/\[(.+?)\]/', $e->getMessage(), $match);
                return $this->simpleResponse->exception(trans('exceptions.no_relation', ['data' => $match[1] ?? '']), Response::HTTP_NOT_FOUND);
            }

            if ($e instanceof AuthorizationException) {
                return $this->simpleResponse->exception($e);
            }

            if ($e instanceof AuthenticationException) {
                return $this->simpleResponse->exception(trans('exceptions.authentication'), Response::HTTP_UNAUTHORIZED);
            }

            if ($e instanceof FilterException) {
                return $this->simpleResponse->exception($e, $e->getCode(), $e->getErrors());
            }

            if ($e instanceof MethodNotAllowedHttpException) {
                return $this->simpleResponse->exception(trans('exceptions.wrong_endpoint', [
                    'verb' => $request->getMethod(),
                    'url' => $request->fullUrl()
                ]));
            }

            return $this->simpleResponse->exception(trans('exceptions.server_error'), Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return parent::render($request, $e);
    }

    /**
     * @param Request $request
     * @param AuthenticationException $exception
     *
     * @return JsonResponse
     */
    protected function unauthenticated($request, AuthenticationException $exception)
    {
        if ($request->wantsJson()) {
            return $this->simpleResponse->exception('authentication', Response::HTTP_UNAUTHORIZED);
        }
    }
}
