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
     */
    public function handle($request, Closure $next)
    {
        //如果用户没有验证邮箱则跳转到验证邮箱form
        if (!is_null($request->user()) && !$request->user()->verified) {
            app(Alert::class)->setDanger('您的邮箱还没有通过验证！');
            return redirect()->guest(route('resend_verify_email'));
        }
        return $next($request);
    }
}
