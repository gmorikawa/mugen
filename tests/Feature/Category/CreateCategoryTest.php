<?php

namespace Tests\Feature\Category;

use App\Models\Category;
use Tests\TestCase;

class CreateCategoryTest extends TestCase
{
    public function test_creates_category(): void
    {
        $category = Category::factory()->makeOne();

        $response = $this
            ->post('/api/categories', $category->toArray())
            ->assertStatus(201);

        $created = $response->decodeResponseJson();

        $this->assertNotEmpty($created['id']);
        $this->assertEquals($category->name, $created['name']);
        $this->assertEquals($category->description, $created['description']);
    }
}
