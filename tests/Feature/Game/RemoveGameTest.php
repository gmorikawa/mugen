<?php

namespace Tests\Feature\Game;

use App\Models\Game;
use Tests\TestCase;

class RemoveGameTest extends TestCase
{
    public function test_removes_game(): void
    {
        $game = Game::factory()->create();

        $response = $this
            ->delete("/api/games/{$game->id}")
            ->assertStatus(200);

        $this->assertDatabaseMissing('games', $game->toArray());
    }
}
