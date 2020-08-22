<?php

namespace App\Console;

use App\Console\Commands\Expiration;
use App\Console\Commands\NotifyScheduler;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**The Artisan commands provided by your application.
     *Kernel بي Expiration  هذا الامر لي نقوم بي رابط */
    protected $commands = [
        \App\Console\Commands\Expiration::class,
        // \App\Console\Commands\NotifyScheduler::class,
    ];

    /**
     * Define the application's command schedule.
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule*/
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')
        //          ->hourly();

        $schedule->command('user:expire')
                 ->everyMinute();

        $schedule->command('notify:email')
                 ->everyMinute();
    }

    /**
     * Register the commands for the application.*/
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
