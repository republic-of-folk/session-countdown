<?php

namespace Database\Seeders;

use App\Models\GameSession;
use Illuminate\Database\Seeder;

class GameSessionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        GameSession::factory()
                   ->count(3)
                   ->create();
    }
}
