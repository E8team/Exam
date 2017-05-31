<?php

namespace App\Http\Middleware;

use App\Services\MockService;
use Closure;
use Auth;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class IsMockEnded
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {


        if(Auth::check()){
            try{
                $mockRecord = app(MockService::class)->getNotEndedMockRecord(Auth::user());

                if(!$mockRecord->isEnded()){
                    if($mockRecord->isOvertime()){

                        // 跳转到 结束模拟页面
                    }else{
                        // 模拟没有结束 跳转到模拟界面去
                    }
                }
            }catch (ModelNotFoundException $exception) {}
        }

        return $next($request);
    }


}
