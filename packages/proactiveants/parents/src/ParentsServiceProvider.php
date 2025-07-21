<?php

namespace ProactiveAnts\Parents;

use Illuminate\Support\ServiceProvider;
use Illuminate\Console\Scheduling\Schedule;

class ParentsServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__.'/routes/web.php');
        $this->loadRoutesFrom(__DIR__.'/routes/api.php');
        $this->loadViewsFrom(__DIR__.'/views','parents');
        $this->publishes([
            __DIR__.'/views' => base_path('resources/views/proactiveants/parents'),
            __DIR__.'/config/parents.php' => config_path('parents.php'),
        ]);
        $this->publishes([__DIR__.'/assets' => base_path('public'),'public']);
        $this->loadMigrationsFrom(__DIR__.'/migrations');

        $this->app->booted(function(){
            $schedule = $this->app->make(Schedule::class);
            $schedule->command('proactiveants:deleteotp')->everyMinute();
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->make('ProactiveAnts\Parents\ParentsAppUserController');
        $this->app->make('ProactiveAnts\Parents\ParentsAppPaymentController');
        $this->app->make('ProactiveAnts\Parents\ParentsAppAPIController');
        $this->app->make('ProactiveAnts\Parents\ParentsAppStudentAPIController');
        $this->app->make('ProactiveAnts\Parents\ParentsAppParentsAPIController');
        $this->app->singleton(Parents::class, function(){
            return new Parents();
        });
        $this->app->alias(Parents::class, 'parents');
        $this->mergeConfigFrom(__DIR__.'/config/parents.php','parents');
        $this->commands([
            'ProactiveAnts\Parents\DeleteUnverifiedOTP'
        ]);
    }
}
