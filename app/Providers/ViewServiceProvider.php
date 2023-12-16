<?php

namespace App\Providers;

use App\Models\Ver_admin_menu;
use App\Models\Ver_staff_menu;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
        

        Facades\View::composer('gr.layout.app', function (View $view) {
            
                
                    $menu = Ver_admin_menu::where('parent',0)->get();       
            
           
               
            
            $view->with('menus',$menu);
        });
    }
}
