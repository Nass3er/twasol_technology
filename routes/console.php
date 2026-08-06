<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

// Check expiring maintenance contracts daily at 8:00 AM
Schedule::command('app:check-contracts-expiry')->dailyAt('08:00');