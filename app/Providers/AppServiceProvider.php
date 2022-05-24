<?php

namespace App\Providers;

use Laravel\Cashier\Cashier;
use Illuminate\Support\ServiceProvider;
use Inertia\Inertia;


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
        view()->composer('layouts.pages.app', function ($view) {
            $view->with('pages', \App\Models\Page::all());
        });
        
        Inertia::share('flash', function () {
            return [
                'success' => \Session::get('success'),
                'error' => \Session::get('error'),
                'status' => \Session::get('status'),
            ];
        });
    }
}
