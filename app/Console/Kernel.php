<?php

namespace App\Console;

use Illuminate\Support\Facades\DB;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        // $schedule->command('inspire')->hourly();
        $schedule->call('App\Http\Controllers\SampleWebSocketTest@test')->everyMinute();
        // $schedule->call('App\Http\Controllers\SampleWebSocketTest@test')->everyFiveSeconds();
        // $schedule->command('email:daily')->dailyAt('00:00');
        // $schedule->command('backup:clean')->daily()->at('01:00');
        // $schedule->command('backup:run')->daily()->at('02:00');
        // $schedule->command('queue:retry all')->hourly();
        // $schedule->command('queue:flush')->weekly();
        // $schedule->command('sanctum:prune-expired --hours=24')->daily();
        // $schedule->command('auth:clear-resets')->daily();

        // $schedule->call(function () {
        //     DB::table('users')->whereNotNull('deleted_at')
        //         ->where('deleted_at', '<', now()->subDays(30))
        //         ->delete();
        // })->daily();
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
