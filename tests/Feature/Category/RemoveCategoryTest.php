<?php

namespace Tests\Feature\Category;

use App\Models\Category;
use Tests\TestCase;

class RemoveCategoryTest extends TestCase
{
    public function test_removes_category(): void
    {
        $category = Category::factory()->create();

        $response = $this
            ->delete("/api/categories/{$category->id}")
            ->assertStatus(200);

        $this->assertDatabaseMissing('categories', $category->toArray());
    }
}
