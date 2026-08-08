<?php

use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\MaintenanceContractController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\StatisticController;
use App\Http\Controllers\Admin\Settings\MailSettingController;
use App\Http\Controllers\Admin\Users\UsersManagementtController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\WebsiteController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

if (!function_exists('localizedRoute')) {
    function localizedRoute($name, $parameters = [], $absolute = true)
    {
        if (str_starts_with($name, 'http')) {
            return $name;
        }
        try {
            return route($name, $parameters, $absolute);
        } catch (\Exception $e) {
            return url(app()->getLocale() . '/' . ltrim($name, '/'));
        }
    }
}

// Sitemap Route for Search Engine Crawlers
Route::get('/sitemap.xml', [WebsiteController::class, 'sitemap'])->name('sitemap');

Route::get('/link-storage', function () {
    Artisan::call('storage:link');
    return 'Storage link created successfully!';
});

Route::get('/clear-all-cache', function () {
    Artisan::call('view:clear');
    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('route:clear');
    
    return 'All cache (Views, Application Cache, Config, Routes) cleared successfully!';
});

// Explicit Favicon route with no-cache headers to force browser update
Route::get('/favicon.ico', function () {
    $possibleFiles = [
        public_path('favicon.ico'),
        base_path('public/favicon.ico'),
        base_path('public_html/favicon.ico'),
        base_path('../public_html/favicon.ico'),
    ];
    foreach ($possibleFiles as $file) {
        if (file_exists($file) && is_file($file)) {
            return response()->file($file, [
                'Content-Type' => 'image/x-icon',
                'Cache-Control' => 'no-cache, no-store, must-revalidate, max-age=0',
                'Pragma' => 'no-cache',
                'Expires' => '0',
            ]);
        }
    }
    abort(404);
});

// Dynamic Uploaded Files Fallback Route (Guarantees image display on all hosting environments)
Route::get('/uploads/{path}', function ($path) {
    $possiblePaths = [
        public_path('uploads/' . $path),
        base_path('public/uploads/' . $path),
        base_path('public_html/uploads/' . $path),
        base_path('../public_html/uploads/' . $path),
        storage_path('app/public/uploads/' . $path),
    ];

    foreach ($possiblePaths as $file) {
        if (file_exists($file) && is_file($file)) {
            $mimeType = mime_content_type($file) ?: 'image/jpeg';
            return response()->file($file, [
                'Content-Type' => $mimeType,
                'Cache-Control' => 'public, max-age=31536000',
            ]);
        }
    }

    abort(404);
})->where('path', '.*');

// Default root: redirect to locale
Route::get('/', function () {
    $locale = Session::get('locale') ?? app()->getLocale();
    return redirect($locale);
});

Route::group([
    'prefix' => '{locale}',
    'middleware' => ['SetLocale'],
], function () {

    // =============================
    // AUTH ROUTES
    // =============================
    Route::prefix('Admin-Panel')->group(function () {
        Auth::routes();
    });

    // =============================
    // ADMIN DASHBOARD ROUTES
    // =============================
    Route::prefix('Admin-Panel')->middleware(['auth'])->group(function () {

        // Dashboard Home
        Route::get('/Dashboard', [HomeController::class, 'index'])->name('home');

        // Services
        Route::resource('services', ServiceController::class);
        Route::put('services/{id}/toggle-active', [ServiceController::class, 'toggleActive'])->name('services.toggleActive');
        Route::delete('services/images/{id}', [ServiceController::class, 'destroyImage'])->name('services.destroyImage');

        // Customers
        Route::resource('customers', CustomerController::class);
        Route::put('customers/{id}/toggle-active', [CustomerController::class, 'toggleActive'])->name('customers.toggleActive');

        // Maintenance Contracts
        Route::resource('contracts', MaintenanceContractController::class);
        Route::put('contracts/{id}/toggle-active', [MaintenanceContractController::class, 'toggleActive'])->name('contracts.toggleActive');
        Route::put('contracts/{id}/renew', [MaintenanceContractController::class, 'renew'])->name('contracts.renew');

        // Statistics
        Route::resource('statistics', StatisticController::class);
        Route::put('statistics/{id}/toggle-active', [StatisticController::class, 'toggleActive'])->name('statistics.toggleActive');

        // Company Settings
        Route::get('/settings', [SettingsController::class, 'index'])->name('admin.settings.index');
        Route::put('/settings', [SettingsController::class, 'update'])->name('admin.settings.update');

        // Users
        Route::middleware(['SuperAdmin'])->group(function () {
            Route::resource('users-management', UsersManagementtController::class);
            Route::put('users-management/{users_management}/toggle-active', [UsersManagementtController::class, 'toggleActive'])->name('users-management.toggleActive');
        });

        Route::get('/change-password', [UsersManagementtController::class, 'changePasswordIndex'])->name('change-password.index');
        Route::post('change-password', [UsersManagementtController::class, 'changePassword'])->name('change-password');

        // Mail settings
        Route::prefix('/settings')->group(function () {
            Route::get('/mail', [MailSettingController::class, 'index'])->name('admin.settings.mail');
            Route::get('/mail/{id}/edit', [MailSettingController::class, 'edit'])->name('admin.settings.mail.edit');
            Route::put('/mail/{id}', [MailSettingController::class, 'update'])->name('admin.settings.mail.update');
        });
    });

    // =============================
    // PUBLIC WEBSITE ROUTES
    // =============================
    Route::get('/lang/{lang}', [LanguageController::class, 'switchLang'])->name('lang.switch');

    Route::get('/', [WebsiteController::class, 'home'])->name('welcome');
    Route::get('/about', [WebsiteController::class, 'about'])->name('about');
    Route::get('/services', [WebsiteController::class, 'services'])->name('services.landing');
    Route::get('/customers', [WebsiteController::class, 'customers'])->name('customers.landing');
    Route::get('/customer-service', [WebsiteController::class, 'customerService'])->name('customer-service');
    Route::post('/customer-service/submit', [WebsiteController::class, 'submitServiceRequest'])->name('customer-service.submit');
    Route::get('/contact', [WebsiteController::class, 'contact'])->name('contact');
});