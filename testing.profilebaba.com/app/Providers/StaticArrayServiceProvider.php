<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App;
class StaticArrayServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        App::bind('staticarray',function(){
            return new \App\Helpers\StaticArray;
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
