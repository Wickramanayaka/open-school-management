<?php

namespace ProactiveAnts\Discipline;

use Illuminate\Support\ServiceProvider;
use ProactiveAnts\Discipline\Disobedience;
use Auth;

class DisciplineServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__.'/routes/web.php');
        $this->loadViewsFrom(__DIR__.'/views','discipline');
        $this->publishes([
            __DIR__.'/views' => base_path('resources/views/proactiveants/discipline'),
            __DIR__.'/config/discipline.php' => config_path('discipline.php'),
        ]);
        $this->publishes([__DIR__.'/assets' => base_path('public'),'public']);
        $this->loadMigrationsFrom(__DIR__.'/migrations');

        if($this->app->runningInConsole()){
            $this->commands([
                DisciplinePointEarnMonthlyManual::class,
                DisciplinePointEarnMonthly::class,
                DisciplinePointAllocationAnnual::class
            ]);
        }

        $this->app['validator']->extend('authorized',function($attribute, $value, $parameter){
            // Compare logged user role against the disobedience category authorized role
            $disobey = Disobedience::find($value);
            foreach($disobey->category->roles as $i){
                foreach(Auth::user()->roles as $j){
                    if($i->id==$j->id){
                        return true;
                    }
                }
            }
            return false;
            
        }, 'You do not have enough authorization to proceed.');

        $this->registerHelpers();
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->make('ProactiveAnts\Discipline\DisciplineController');
        $this->app->make('ProactiveAnts\Discipline\DisobedienceCategoryController');
        $this->app->make('ProactiveAnts\Discipline\DisobedienceController');
        $this->app->make('ProactiveAnts\Discipline\DisciplineReportController');
        $this->app->make('ProactiveAnts\Discipline\DisobedienceStudentController');

        $this->app->singleton(Discipline::class, function(){
            return new Discipline();
        });
        $this->app->alias(Discipline::class, 'discipline');
        $this->mergeConfigFrom(__DIR__.'/config/discipline.php','discipline');

    }

    public function registerHelpers()
    {
        if(file_exists($file = __DIR__.'/helpers.php')){
            require $file;
        }
    }
}
