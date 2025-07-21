<?php

namespace ProactiveAnts\SMS;

use Illuminate\Support\ServiceProvider;
use Auth;

class SMSServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__.'/routes/web.php');
        $this->loadViewsFrom(__DIR__.'/views','sms');
        $this->publishes([
            __DIR__.'/views' => base_path('resources/views/proactiveants/sms'),
            __DIR__.'/config/sms.php' => config_path('sms.php'),
        ]);
        $this->publishes([__DIR__.'/assets' => base_path('public'),'public']);
        $this->loadMigrationsFrom(__DIR__.'/migrations');

        if($this->app->runningInConsole()){
            $this->commands([
                // DisciplinePointEarnMonthlyManual::class,
                // DisciplinePointEarnMonthly::class,
                // DisciplinePointAllocationAnnual::class
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
        $this->app->make('ProactiveAnts\SMS\SMSController');
        $this->app->make('ProactiveAnts\SMS\SMSTemplateController');
        $this->app->make('ProactiveAnts\SMS\SMSReportController');
        // $this->app->make('ProactiveAnts\Discipline\DisciplineReportController');
        // $this->app->make('ProactiveAnts\Discipline\DisobedienceStudentController');

        $this->app->singleton(SMS::class, function(){
            return new SMS();
        });
        $this->app->alias(SMS::class, 'sms');
        $this->mergeConfigFrom(__DIR__.'/config/sms.php','sms');

    }

    public function registerHelpers()
    {
        if(file_exists($file = __DIR__.'/helpers.php')){
            require $file;
        }
    }
}
