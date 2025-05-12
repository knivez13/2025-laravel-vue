<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Mail\DailyReminderMail;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendDailyEmail extends Command
{
    protected $signature = 'email:daily';
    protected $description = 'Send daily email to all users at 12 AM';
    public function handle()
    {
        $users = User::all();

        foreach ($users as $user) {
            Mail::to($user->email)->queue(new DailyReminderMail());
        }

        $this->info('Daily emails sent successfully.');
    }
}
