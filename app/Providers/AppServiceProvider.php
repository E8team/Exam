<?php

namespace App\Providers;

use App\Widgets\Alert;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(
            Alert::class, function ($app) {
            $defaultConfig = [
                'default_type' => 'info',
                'default_has_button' => false,
                'default_need_container' => true,
                'allow_type_list' => [
                    'info', 'success', 'warning', 'danger'
                ]
            ];
            $config = array_merge($defaultConfig, $app->make('config')['alert']);
            return new Alert($app->make('session.store'), $config);
        }
        );
        if ($this->app->environment() !== 'production') {
            $this->app->register(\Barryvdh\Debugbar\ServiceProvider::class);
            $this->app->register(\Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class);
        }
    }
}
