<?php

namespace App\Providers;

use App\Support\Storage\Constract\StorageInterface;
use App\Support\Storage\SessionStorage;
use Illuminate\Support\ServiceProvider;
use mysql_xdevapi\Session;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
       $this->app->bind(StorageInterface::class,function ($app){
           return new SessionStorage('cart');
       });
    }
}
