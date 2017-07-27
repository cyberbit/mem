<?php

namespace App\Providers;

use Illuminate\Support\Facades\DB;
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
        /*DB::listen(function($query) {
            echo "<pre>";
            print_r($query->sql);
            echo "</pre>";
        });*/
        
        // Set timezone
        //DB::statement("SET time_zone = 'America/Chicago'");
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
