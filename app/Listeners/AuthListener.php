<?php

namespace App\Listeners;

use App\Events\BaseEvent;
use Illuminate\Auth\Events\Registered;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class AuthListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  BaseEvent  $event
     * @return void
     */
    public function handle(BaseEvent $event)
    {
        if($event instanceof Registered){
            // 注册成功
        }
    }
}
