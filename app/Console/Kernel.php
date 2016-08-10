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
        Commands\Inspire::class,
        Commands\FetchClan::class,
        Commands\ProcessClan::class,
        Commands\FetchLeague::class,
    ];

    /**
     * Define the application's command schedule.
     *
     *  ┌───────────── min (0 - 59)
     *  │ ┌────────────── hour (0 - 23)
     *  │ │ ┌─────────────── day of month (1 - 31)
     *  │ │ │ ┌──────────────── month (1 - 12)
     *  │ │ │ │ ┌───────────────── day of week (0 - 6) (0 to 6 are Sunday to Saturday, or use names; 7 is also Sunday)
     *  │ │ │ │ │ ┌────────────────── year (1900 - 3000)
     *  * * * * * *  command to execute
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('coc:fetchClan')
                 ->cron('0,1,2,3,4,5,55,56,57,58,59 * * * * *')->withoutOverlapping();

        $schedule->command('coc:processClan')
                 ->everyMinute()->withoutOverlapping();
    }
}
