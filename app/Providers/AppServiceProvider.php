<?php

namespace Unicorn\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Queue\Events\JobProcessed;
use Queue;
use Log;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Queue::after(function($connection, $job, $data) {
        	Log::info('Job Event Description:'.$connection.' '.$job->getName());        	
        	Log::info('Job Event Data :'.json_encode($data));
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
