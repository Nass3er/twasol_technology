<?php

namespace App\Providers;

use App\Models\Setting;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class ViewServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        if (!app()->runningInConsole()) {
            View::composer(['layouts.app', 'daisyUI.footer', 'daisyUI.navbar-upper-2', 'landingPage.*'], function ($view) {
                $settings = Setting::all()->pluck('value', 'para')->all();
                
                $logoSetting = Setting::where('para', 'logo')->first();
                $logoPath = $logoSetting?->imagepath;

                $view->with([
                    'settings' => $settings,
                    'logoPath' => $logoPath,
                ]);
            });
        }
    }
}