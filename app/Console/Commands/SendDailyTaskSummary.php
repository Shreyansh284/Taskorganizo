<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Mail\DailyTodoList;
use App\Models\User;

class SendDailyTaskSummary extends Command
{
    protected $signature = 'send:daily-task-summary';

    protected $description = 'Send the daily task summary email';

    public function handle()
    {
        $users = User::all();

        foreach ($users as $user) {
            Mail::to($user->email)->send(new DailyTodoList($user));
            $this->info('Daily task summary email sent to ' . $user->email);
        }
    }
}
