<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class ResetPassword extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:reset {email}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Reset user password';

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

        if (!$user)
        {
            echo "Error: User $email does not exists\n";

            return 1;
        }

        $password = $this->secret('New password');
        $password_confirm = $this->secret('New password (repeat)');

        if ($password != $password_confirm)
        {
            echo "Error: Passwords do not match\n";

            return 1;
        }

        $user->password = Hash::make($password);
        $user->save();

        return 0;
    }
}
