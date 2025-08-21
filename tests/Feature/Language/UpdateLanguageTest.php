<?php

namespace Tests\Feature\Language;

use App\Models\Language;
use Tests\TestCase;

class UpdateLanguageTest extends TestCase
{
    public function test_updates_language(): void
    {
        $former = Language::factory()->create();
        $latter = Language::factory()->makeOne();

        $response = $this
            ->patch("/api/languages/{$former->id}", $latter->toArray())
            ->assertStatus(200);

        $updated = $response->decodeResponseJson();

        $this->assertEquals($former->id, $updated['id']);
        $this->assertEquals($latter->name, $updated['name']);
        $this->assertEquals($latter->iso_code, $updated['iso_code']);
    }
}
