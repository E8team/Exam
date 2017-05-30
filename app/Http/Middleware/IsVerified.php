<?php

namespace App\Http\Middleware;

use App\Widgets\Alert;
use Closure;

class IsVerified extends \Jrean\UserVerification\Middleware\IsVerified
{

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     *
     * @throws Jrean\UserVerification\Exceptions\UserNotVerifiedException
     */
    public function handle($request, Closure $next)
    {
        //如果用户没有验证邮箱则跳转到验证邮箱form
        if (!is_null($request->user()) && !$request->user()->verified) {
            return redirect(route('resend_verify_email'));
        }
        return $next($request);
    }
}
