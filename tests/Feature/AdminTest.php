<?php

namespace Tests\Feature;

use App\Models\GameSession;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

/**
 * @property User        user
 * @property GameSession game_session_past
 * @property GameSession game_session_current
 * @property GameSession game_session_next
 * @property GameSession game_session_future
 */
class AdminTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()
                          ->create();

        $this->game_session_past = GameSession::factory()
                                              ->create([
                                                  'event_date' => $this->faker->dateTimeBetween('-2 days', '-1 days'),
                                              ]);
        $this->game_session_current = GameSession::factory()
                                                 ->create([
                                                     'event_date' => $this->faker->dateTimeBetween('+1 days', '+2 days'),
                                                 ]);
        $this->game_session_next = GameSession::factory()
                                              ->create([
                                                  'event_date' => $this->faker->dateTimeBetween('+2 days', '+3 days'),
                                              ]);
        $this->game_session_future = GameSession::factory()
                                                ->create([
                                                    'event_date' => $this->faker->dateTimeBetween('+4 days', '+5 days'),
                                                ]);
    }

    public function test_gameSessionApiReturnsAllSessions()
    {
        $response = $this->actingAs($this->user, 'api')
                         ->get('/api/game-session');
        $response->assertOk();
        $response->assertJsonCount(4);
    }

    public function test_gameSessionApiReturnsCorrectSingleSession()
    {
        $game_session_data = $this->game_session_current;

        $response = $this->actingAs($this->user, 'api')
                         ->get("/api/game-session/$game_session_data->id");
        $response->assertOk();
        $response->assertJson([
            'name'       => $game_session_data->name,
            'event_date' => $game_session_data->event_date->format('Y-m-d H:i:s'),
        ]);
    }

    public function test_gameSessionApiPostSavesNewGameSession()
    {
        /** @var GameSession $new_game_session_data */
        $new_game_session_data = GameSession::factory()
                                            ->make();

        // Create new game session
        $response = $this->actingAs($this->user, 'api')
                         ->post('/api/game-session', [
                             'name'       => $new_game_session_data->name,
                             'event_date' => $new_game_session_data->event_date,
                         ]);

        // Assert it's created and returns session created from given data
        $response->assertCreated();
        $response->assertJson([
            'name'       => $new_game_session_data->name,
            'event_date' => $new_game_session_data->event_date,
        ]);

        // Assert created session gets saved in the database.
        $new_game_session_id = $response->json('id');
        $response = $this->actingAs($this->user, 'api')
                         ->get("/api/game-session/$new_game_session_id");
        $response->assertOk();
        $response->assertJson([
            'name'       => $new_game_session_data->name,
            'event_date' => $new_game_session_data->event_date,
        ]);
    }
}
