<?php

namespace App\Providers;

use Illuminate\Http\Request;
use App\Models\Admin\Setting;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{

    public function register(): void
    {

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(Request $request): void
    {
        view()->composer(['backend.layouts.sidebar','auth.login','auth.register'], function ($view) use ($request) {
            $view->with('setting', Setting::hassetting($request));
        });
    }
}
