<?php

namespace Tests\Feature\Category;

use App\Models\Category;
use Tests\TestCase;

class UpdateCategoryTest extends TestCase
{
    public function test_updates_category(): void
    {
        $former = Category::factory()->create();
        $latter = Category::factory()->makeOne();

        $response = $this
            ->patch("/api/categories/{$former->id}", $latter->toArray())
            ->assertStatus(200);

        $updated = $response->decodeResponseJson();

        $this->assertEquals($former->id, $updated['id']);
        $this->assertEquals($latter->name, $updated['name']);
        $this->assertEquals($latter->description, $updated['description']);
    }
}
