<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class DailyReminderMail extends Mailable
{
    use Queueable, SerializesModels;

    public function build()
    {
        return $this->subject('Daily Reminder')
            ->view('emails.daily_reminder');
    }
}
