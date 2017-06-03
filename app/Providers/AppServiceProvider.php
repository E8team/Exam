<?php

namespace App\Providers;

use App\Services\DepartmentClassService;
use App\Services\StudentService;
use App\Services\TopicService;
use App\Widgets\Alert;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Gate;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        Gate::define('mock', function ($user, $mockRecord) {
            return $mockRecord->user_id == $user->id;
        });
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
        $this->app->singleton(TopicService::class, function (){
            return new TopicService();
        });
        $this->app->singleton(DepartmentClassService::class, function (){
            return new DepartmentClassService();
        });
        $this->app->singleton(StudentService::class, function (){
            return new StudentService();
        });
        $this->app->singleton(MockService::class, function (){
            return new MockService();
        });
        if ($this->app->environment() !== 'production') {
            $this->app->register(\Barryvdh\Debugbar\ServiceProvider::class);
            $this->app->register(\Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class);
        }
    }
}
