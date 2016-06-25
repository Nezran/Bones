<?php

namespace App\Providers;

use View;
use App\Models\User;
use App\Models\Invitation;
use Illuminate\Support\Facades\Auth;
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
        //
        ;
        View::composer('layouts/app', function($view){
            $invitations = Invitation::where("status","=","wait")->get();
            $view->with('invitations', $invitations);
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

    }
}
