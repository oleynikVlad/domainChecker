<?php

use App\Models\Setting;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

$checkInterval = Cache::rememberForever('check_interval', function () {
    if (Schema::hasTable('settings')) {
        return Setting::query()->first()->value ?? 5;
    }
    return 5;
});

Schedule::command('domains:check')
    ->cron("*/{$checkInterval} * * * *")
    ->withoutOverlapping()
    ->onOneServer();
