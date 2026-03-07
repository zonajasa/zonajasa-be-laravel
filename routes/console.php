<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Schedule::command('otp:check-expire')
    ->everyThirtySeconds() //after 30 detik
    ->withoutOverlapping(10) //under 10 seconds for timeout
    ->name('otp-check-expire');
