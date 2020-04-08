<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Tools\ReadMoni;

class ReadMoniServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('ReadMoni', function(){
            return new ReadMoni;
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
