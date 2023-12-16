<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App;

class CustomValueServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
      App::bind('customvalue', function()
      {
        return new \App\Helpers\CustomValue;
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
