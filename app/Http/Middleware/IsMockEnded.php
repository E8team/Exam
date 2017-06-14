<?php

namespace App\Http\Middleware;

use App\Services\MockService;
use Closure;
use Auth;
use App\Widgets\Alert;
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
                    if(!$mockRecord->isOvertime()){
                        $mockUrl = route('mock',['mockRecordId' => $mockRecord->id]);
                        if($request->url() != $mockUrl)
                            return redirect()->guest(route('cue_mocking', ['mockRecordId'=>$mockRecord->id]));
                    }else{
                        return redirect()->guest(route('cue_overtime_mock', ['mockRecordId'=>$mockRecord->id]));
                    }

                }

            }catch (ModelNotFoundException $exception) {}
        }

        return $next($request);
    }


}
