<?php

namespace App\Console\Commands;


use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class CreateUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:create {username?} {fullname?} {email?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a user';

    /**
     * Create a new command instance.
     *
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        if (!($username = $this->argument('username'))) {
            $username = $this->ask('Username');
        }

        if (!($fullname = $this->argument('fullname'))) {
            $fullname = $this->ask('Full name');
        }
        if (!($email = $this->argument('email'))) {
            $email = $this->ask('Email');
        }

        if ($this->confirm('Generate password for you')) {
            $password = $this->generatePassword();
            $this->info("Your password is: $password");
        } else {
            $password = $this->secret('Password');
        }

        $user = new User([
            'username' => $username,
            'fullname' => $fullname,
            'email'    => $email,
            'password' => Hash::make($password)
        ]);
        $user->save();

        $this->info("User {$username} created");
    }

    protected function generatePassword()
    {
        $length = mt_rand(6, 12);

        return str_random($length);
    }
}
