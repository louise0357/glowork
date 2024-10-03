<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use App\Jobs\NotifyDueTasks;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

Artisan::command('notify:due-tasks', function () {
    (new NotifyDueTasks())->handle();
    $this->info('NotifyDueTasks job çalıştırıldı.');
});
