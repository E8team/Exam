<?php

namespace App\Http\Middleware;

use Auth;
use Closure;
use Illuminate\Auth\Access\AuthorizationException;

class CheckUserIsSelectedCourses
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure                 $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::check() && !Auth::user()->is_selected_courses) {
            throw new AuthorizationException('请先选择课程');
        }
        return $next($request);
    }
}
