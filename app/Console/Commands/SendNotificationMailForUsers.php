<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Notifications\PastOneMonthUsers;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Notification;


class SendNotificationMailForUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notify:users-not-logged-in-for-month';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'send email notification to users who did not login for the past month';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        //get all users who didn't login for a month
        $users = User::where('last_login_at','<=',Carbon::now()->subMonth()->toDateTimeString())->get();
        Notification::send($users, new PastOneMonthUsers());
        return 0;
    }
}
