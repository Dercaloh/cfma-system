<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;
Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');


Schedule::command('backup:run --only-db')
    ->dailyAt('19:00') // Cambia a la hora que desees
    ->runInBackground()
    ->onOneServer();
