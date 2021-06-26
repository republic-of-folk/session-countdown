<?php

namespace Tests\Feature;

use App\Models\GameSession;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SiteTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    private GameSession $game_session_past;

    private GameSession $game_session_current;

    private GameSession $game_session_next;

    private GameSession $game_session_future;

    public function setUp(): void
    {
        parent::setUp();

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

    public function test_homeViewExists()
    {
        $response = $this->get('/');
        $response->assertOk();
        $response->assertViewIs('Site.countdown');
    }

    public function test_gameSessionApiShowsOnlyTwoNextSessions()
    {
        $response = $this->get('/');

        $response->assertDontSeeText($this->game_session_past->event_date->format('Y-m-d H:i:s'));
        $response->assertSeeTextInOrder([
            $this->game_session_current->event_date->format('Y-m-d H:i:s'),
            $this->game_session_next->event_date->format('Y-m-d H:i:s'),
        ]);
        $response->assertDontSeeText($this->game_session_future->event_date->format('Y-m-d H:i:s'));
    }
}
