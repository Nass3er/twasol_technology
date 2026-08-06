<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Post;
use App\Models\Page;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     */
    public function boot(): void
    {

        /*  Route::bind('post', function ($value) {
            $locale = app()->getLocale();
            $lang_no = ($locale === 'ar' ? 1 : 2);

            return Post::where('slug', $value)
                ->where('lang_no', $lang_no)
                ->firstOrFail();
        });

        Route::bind('page', function ($value) {
            $locale = app()->getLocale();
            $lang_no = ($locale === 'ar' ? 1 : 2);

            return Page::where('slug', $value)
                ->where('lang_no', $lang_no)
                ->firstOrFail();
        });  */


        if (!app()->runningInConsole()) {
            Route::bind('post', function ($value) {
                $locale = app()->getLocale();
                $lang_no = ($locale === 'ar' ? 1 : 2);
                return Post::where('slug', $value)->where('lang_no', $lang_no)->firstOrFail();
            });

            Route::bind('page', function ($value) {
                $locale = app()->getLocale();
                $lang_no = ($locale === 'ar' ? 1 : 2);
                return Page::where('slug', $value)->where('lang_no', $lang_no)->firstOrFail();
            });
        }



    }
}
