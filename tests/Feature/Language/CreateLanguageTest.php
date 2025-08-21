<?php

namespace Tests\Feature\Language;

use App\Models\Language;
use Tests\TestCase;

class CreateLanguageTest extends TestCase
{
    public function test_creates_language(): void
    {
        $language = Language::factory()->makeOne();

        $response = $this
            ->post('/api/languages', $language->toArray())
            ->assertStatus(201);

        $created = $response->decodeResponseJson();

        $this->assertNotEmpty($created['id']);
        $this->assertEquals($language->name, $created['name']);
        $this->assertEquals($language->iso_code, $created['iso_code']);
    }
}
