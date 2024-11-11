<?php

namespace App\Providers;

use App\Models\Website;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('*', function ($view) {
            // You can customize how you retrieve the user data, for example, using Auth facade
            // $user = auth()->user();
            // // Sharing the user data with the view
            // $view->with('user', $user);
            $user = auth()->user();
            // Retrieve all websites
            $websites = Website::all();

            // Share user and websites data with the view
            $view->with('user', $user)
                ->with('websites', $websites);
        });
    }
}