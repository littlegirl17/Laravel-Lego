<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    protected $commands = [
        \App\Console\Commands\UpdateUserGroup::class,
    ];

    protected function schedule(Schedule $schedule)
    {
        // Lên lịch cho các command ở đây
        $schedule->command('app:update-user-group')->daily();
    }

    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        // Đăng ký các lệnh artisan khác ở đây
    }
}