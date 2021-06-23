<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserCreate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:create {email}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create user';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $email = $this->argument('email');

        $user = User::where('email', '=', $email)
                    ->first();

        if ($user)
        {
            echo "Error: User $email already exists\n";

            return 1;
        }

        $password = $this->secret('Password');
        $password_confirm = $this->secret('Password (repeat)');

        $name = $this->ask('Name', $email);

        if ($password != $password_confirm)
        {
            echo "Error: Passwords do not match\n";

            return 1;
        }

        $user = new User();
        $user->password = Hash::make($password);
        $user->email = $email;
        $user->name = $name;
        $user->api_token = Hash::make(Str::random(64));
        $user->save();

        echo "User $email created\n";

        return 0;
    }
}
