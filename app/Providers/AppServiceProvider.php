<?php

namespace App\Providers;

use App\Models\Admin\Category;
use App\Models\Admin\Product;
use App\Models\Admin\Setting;
use App\Models\Admin\Slider;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{

    public function register(): void
    {

    }
    public function boot(Request $request): void
    {
        Paginator::useBootstrap();
        view()->composer(['otp.verify_otp','backend.layouts.sidebar','backend.layouts.main','auth.login','auth.register','frontend.layouts.main','frontend.layouts.section.header','frontend.layouts.section.footer'], function ($view) use ($request) {
            $view->with('setting', Setting::hassetting($request));
        });

        view()->composer(['frontend.section.product'], function ($view) use ($request) {
            $view->with('products', Product::hasproduct($request));
        });

        view()->composer(['frontend.section.header','frontend.pages.home'], function ($view) use ($request) {
            $view->with('categories', Category::hascategory($request));
        });

        view()->composer(['frontend.section.banner'], function ($view) use ($request) {
            $view->with('sliders', Slider::hasslider($request));
        });
    }
}
