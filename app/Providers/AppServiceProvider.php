<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Brand;
use App\Models\ProductCategory;

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
        view()->composer(
            ['includes.header', 'includes.footer', 'home'],
            function ($view) {
                $view->with('productCategory', ProductCategory::where('status', '1')->get());
            }
        );
    }
}
