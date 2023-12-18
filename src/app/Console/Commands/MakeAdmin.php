<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class MakeAdmin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:admin';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'make an admin user';

    /**
     * Execute the console command.
     *
     */
    public function handle()
    {
        $email = $this->ask('Enter email for admin');

        $user = User::whereEmail($email)->first();
        if ($user) {
            $this->error("The email has already been taken");
        }
        else{
            $password = $this->ask('Enter password for admin');
            User::create([
                "name" => "admin",
                "email" => $email,
                "password" => bcrypt($password),
                "is_admin" => true,
            ]);
            $this->info("creation was successful");
        }

    }
}
