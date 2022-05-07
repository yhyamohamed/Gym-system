<?php

namespace App\Console\Commands;


use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class CreateAdmin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:admin {--email=} {--password=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $check = User::where('email', $this->option('email'))->count();
        if ($check == 0) {
            $admin = User::create([
                'email' => $this->option('email'),
                'password' => Hash::make($this->option('password')),
                'name' => 'Admin',
                'position_id' => 1,
            ]);
            $admin->assignRole('admin');
            $this->info('The command was successful!');
        } else {
            $this->error('Email already exists!');
        }


        return 0;
    }
}
