<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class MakeUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:user';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'make a user';

    /**
     * Execute the console command.
     *
     */
    public function handle()
    {
        $email = $this->ask('Enter email for user');

        $user = User::whereEmail($email)->first();
        if ($user) {
            $this->error("The email has already been taken");
        }
        else{
            $password = $this->ask('Enter password for user');
            User::create([
                "name" => "user",
                "email" => $email,
                "password" => bcrypt($password),
                "is_admin" => false,
            ]);
            $this->info("creation was successful");
        }
    }
}
