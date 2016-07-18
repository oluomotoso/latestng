<?php

namespace newsbook\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        \newsbook\Console\Commands\Inspire::class,
        \newsbook\Console\Commands\FetchPost::class,
        \newsbook\Console\Commands\FacebookPageShare::class,
        \newsbook\Console\Commands\PostMetrics::class,
        \newsbook\Console\Commands\FacebookGroupShare::class,
        \newsbook\Console\Commands\UpdateTags::class

    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule $schedule
     * @return void
     */

    protected function schedule(Schedule $schedule)
    {
        $schedule->command('post:fetch')->everyFiveMinutes();
        $schedule->command('facebookshare:page')->everyMinute();
        $schedule->command('post:metrics')->everyTenMinutes();
        $schedule->command('post:facebookgroup')->everyThirtyMinutes();

    }
}
