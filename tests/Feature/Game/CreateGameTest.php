<?php

namespace Tests\Feature\Game;

use App\Models\Game;
use Carbon\Carbon;
use Tests\TestCase;

class CreateGameTest extends TestCase
{
    public function test_creates_game(): void
    {
        $game = Game::factory()->makeOne();

        $response = $this
            ->post('/api/games', $game->toArray())
            ->assertStatus(201);

        $created = $response->decodeResponseJson();

        $this->assertNotEmpty($created['id']);
        $this->assertEquals($game->title, $created['title']);
        $this->assertEquals($game->platform_id, $created['platform_id']);
        $this->assertEquals($game->release_date, new Carbon($created['release_date']));
    }
}
