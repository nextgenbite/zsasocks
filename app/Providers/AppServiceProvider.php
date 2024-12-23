<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Page;
use App\Models\Setting;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\ServiceProvider;
use App\Services\LoginPointService;

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
        $this->app->singleton(LoginPointService::class, function ($app) {
            return new LoginPointService();
        });
       
        // Retrieve data from cache or database
        $settings = Cache::remember('config_data', now()->addHours(24), function () {
            return Setting::get()->pluck('value', 'key');
        });

        if ($settings->isNotEmpty()) {
            // Share settings with views
            View::share('settings', $settings);
        } 
    
        // Share other data with views
        $pages = Page::all();
        if ($pages->isNotEmpty()) {
            View::share('pages', $pages);
        }
        $categories = Category::whereCategory_status(true)->with('children')->whereNull('parent_id')->get(['id', 'slug', 'category_name', 'slug', 'parent_id']);

        if ($categories->isNotEmpty()) {
            View::share('categories', $categories);
        }
    
        // Configure Paginator
        Paginator::useBootstrap();
    }
}
