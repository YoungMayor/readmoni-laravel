<?php

namespace App\Providers;

use App\Tools\FlutterwavePay;
use App\Tools\PaystackPay;
use App\Tools\ReadMoni;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('ReadMoni', function(){
            return new ReadMoni;
        });
        $this->app->bind('PaystackPay', function(){
            return new PaystackPay;
        });
        $this->app->bind('FlutterwavePay', function(){
            return new FlutterwavePay;
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
    }
}
