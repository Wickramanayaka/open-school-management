<?php

namespace ProactiveAnts\Coverage;

use Illuminate\Support\ServiceProvider;

class CoverageServiceProvider extends ServiceProvider
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
        $this->loadViewsFrom(__DIR__.'/views','coverage');
        $this->publishes([
            __DIR__.'/views' => base_path('resources/views/proactiveants/coverage'),
            __DIR__.'/config/coverage.php' => config_path('coverage.php'),
        ]);
        $this->publishes([__DIR__.'/assets' => base_path('public'),'public']);
        $this->loadMigrationsFrom(__DIR__.'/migrations');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->make('ProactiveAnts\Coverage\CoverageController');
        $this->app->make('ProactiveAnts\Coverage\ChapterController');
        $this->app->make('ProactiveAnts\Coverage\PinCodeController');
        $this->app->make('ProactiveAnts\Coverage\ManagementController');
        $this->app->make('ProactiveAnts\Coverage\FeedbackController');
        $this->app->make('ProactiveAnts\Coverage\DeviceController');
        $this->app->make('ProactiveAnts\Coverage\CoverageReportController');

        $this->app->singleton(Coverage::class, function(){
            return new Coverage();
        });
        $this->app->alias(Coverage::class, 'coverage');
        $this->mergeConfigFrom(__DIR__.'/config/coverage.php','coverage');
    }
}
