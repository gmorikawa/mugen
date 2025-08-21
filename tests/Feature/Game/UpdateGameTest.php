<?php

namespace Tests\Feature\Game;

use App\Models\Game;
use Carbon\Carbon;
use Illuminate\Support\Facades\Date;
use Tests\TestCase;

class UpdateGameTest extends TestCase
{
    public function test_updates_game(): void
    {
        $former = Game::factory()->create();
        $latter = Game::factory()->makeOne();

        $response = $this
            ->patch("/api/games/{$former->id}", $latter->toArray())
            ->assertStatus(200);

        $updated = $response->decodeResponseJson();

        $this->assertEquals($former->id, $updated['id']);
        $this->assertEquals($latter->title, $updated['title']);
        $this->assertEquals($latter->platform_id, $updated['platform_id']);
        $this->assertEquals($latter->release_date, new Carbon($updated['release_date']));
    }
}
