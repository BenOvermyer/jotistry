<?php

namespace App\Console;

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
        Commands\CacheGithubIssues::class,
        Commands\CacheWeather::class,
        Commands\Inspire::class,
        Commands\UserGeneratorCommand::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param \Illuminate\Console\Scheduling\Schedule $schedule
     *
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('cache:githubissues')
            ->everyFiveMinutes();
        $schedule->command('cache:weather')
            ->everyTenMinutes();
    }
}
