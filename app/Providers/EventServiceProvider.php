<?php

namespace App\Providers;

use App\Events\SubmitedTopic;
use App\Listeners\AuthListener;
use App\Listeners\TopicListener;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        SubmitedTopic::class => [
            TopicListener::class,
        ],
        Registered::class => [
            AuthListener::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
