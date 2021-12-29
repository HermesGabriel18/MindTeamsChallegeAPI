<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class UserLocale
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $userLocale = auth()->user()->locale ?? (request()->get('locale') ?? config('app.locale'));

        app()->setLocale($userLocale);

        return $next($request);
    }
}
