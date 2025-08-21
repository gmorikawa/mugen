<?php

namespace Tests\Feature\Language;

use App\Models\Language;
use Tests\TestCase;

class RemoveLanguageTest extends TestCase
{
    public function test_removes_language(): void
    {
        $language = Language::factory()->create();

        $response = $this
            ->delete("/api/languages/{$language->id}")
            ->assertStatus(200);

        $this->assertDatabaseMissing('languages', $language->toArray());
    }
}
