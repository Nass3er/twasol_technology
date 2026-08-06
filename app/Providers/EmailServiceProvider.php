<?php

namespace App\Providers;
use App\Models\Setting;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class EmailServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        if (!app()->runningInConsole()) {
        if (Schema::hasTable('settings')) {
            $pairs = Setting::query()
                ->whereIn('para', [
                    'mail_mailer',
                    'mail_host',
                    'mail_port',
                    'mail_username',
                    'mail_password',
                    'mail_encryption',
                    'mail_from_address',
                    'mail_from_name',
                ])->pluck('value', 'para');

            if ($pairs && $pairs->isNotEmpty()) {
                // Default mailer
                if (!empty($pairs['mail_mailer'])) {
                    Config::set('mail.default', $pairs['mail_mailer']);
                }

                // SMTP mailer
                Config::set('mail.mailers.smtp', [
                    'transport' => 'smtp',
                    'host' => $pairs['mail_host'] ?? env('MAIL_HOST'),
                    'port' => (int) ($pairs['mail_port'] ?? env('MAIL_PORT', 587)),
                    'username' => $pairs['mail_username'] ?? env('MAIL_USERNAME'),
                    'password' => $pairs['mail_password'] ?? env('MAIL_PASSWORD'),
                    'timeout' => null,
                    'local_domain' => env('MAIL_EHLO_DOMAIN', parse_url(env('APP_URL', 'http://localhost'), PHP_URL_HOST)),
                ]);

                // Map encryption to supported schemes (Laravel 11 uses scheme: smtp|smtps)
                $enc = strtolower((string)($pairs['mail_encryption'] ?? ''));
                $scheme = match ($enc) {
                    'ssl' => 'smtps',        // implicit TLS (465)
                    'tls', 'starttls' => 'smtp', // STARTTLS (587)
                    default => 'smtp',
                };
                Config::set('mail.mailers.smtp.scheme', $scheme );
                // Infer default port if none set
                if (empty($pairs['mail_port'])) {
                    Config::set('mail.mailers.smtp.port', $scheme === 'smtps' ? 465 : 587);
                }

                // From address
                if (!empty($pairs['mail_from_address'])) {
                    Config::set('mail.from.address', $pairs['mail_from_address']);
                }
                if (!empty($pairs['mail_from_name'])) {
                    Config::set('mail.from.name', $pairs['mail_from_name']);
                }
            }
        }
    }
    }
}
