<?php

namespace App\Providers;
use JeroenNoten\LaravelAdminLte\Events\BuildingMenu;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;
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
        if (app()->environment('production')) {
        URL::forceScheme('https');
        URL::forceRootUrl(config('app.url'));
      }
      
        if (!app()->runningInConsole()) {
            // Load mail settings from database
            try {
                if (\Schema::hasTable('settings')) {
                    $mailSettings = \App\Models\Setting::whereIn('para', [
                        'mail_mailer', 'mail_host', 'mail_port', 'mail_username', 
                        'mail_password', 'mail_encryption', 'mail_from_address', 'mail_from_name'
                    ])->get()->keyBy('para');

                    if ($mailSettings->isNotEmpty()) {
                        config([
                            'mail.default' => $mailSettings['mail_mailer']->value ?? config('mail.default'),
                            'mail.mailers.smtp.host' => $mailSettings['mail_host']->value ?? config('mail.mailers.smtp.host'),
                            'mail.mailers.smtp.port' => $mailSettings['mail_port']->value ?? config('mail.mailers.smtp.port'),
                            'mail.mailers.smtp.encryption' => $mailSettings['mail_encryption']->value ?? config('mail.mailers.smtp.encryption'),
                            'mail.mailers.smtp.username' => $mailSettings['mail_username']->value ?? config('mail.mailers.smtp.username'),
                            'mail.mailers.smtp.password' => $mailSettings['mail_password']->value ?? config('mail.mailers.smtp.password'),
                            'mail.from.address' => $mailSettings['mail_from_address']->value ?? config('mail.from.address'),
                            'mail.from.name' => $mailSettings['mail_from_name']->value ?? config('mail.from.name'),
                        ]);
                    }
                }
            } catch (\Exception $e) {
                // Fail gracefully if database is not reachable
            }

            $this->app['events']->listen(BuildingMenu::class, function (BuildingMenu $event) {
            $locale = app()->getLocale();

            // Decide which language to show
            if ($locale === 'en') {
                $langItem = [
                    'key' => 'lang-ar',
                    'text' => 'عربي',
                    // 'classes' => 'fas fa-info-circle',
                    'icon' => 'flag-icon flag-icon-eg',
                    'route'  => ['lang.switch', ['lang' => 'ar']],
                    'topnav_right' => true,
                ];
            } else {
                $langItem = [
                    'key' => 'lang-en',
                    'text' => 'en',
                    // 'classes' => 'fas fa-info-circle',
                    'icon' => 'flag-icon flag-icon-us',
                    'route'  => ['lang.switch', ['lang' => 'en']],
                    // 'url'  => localizedRoute('lang.switch', ['lang' => 'en']),
                    'topnav_right' => true,
                ];
            }

            $event->menu->add($langItem);
        });
    }

    }
}
