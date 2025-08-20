<?php

namespace Tests\Feature\Company;

use App\Models\Company;
use Tests\TestCase;

class CreateCompanyTest extends TestCase
{
    public function test_it_creates_a_company(): void
    {
        $company = Company::factory()->makeOne();

        $response = $this
            ->post('/api/companies', $company->toArray())
            ->assertStatus(201);

        $created = $response->decodeResponseJson();

        $this->assertNotEmpty($created['id']);
        $this->assertEquals($created['name'], $company->name);
        $this->assertEquals($created['description'], $company->description);
    }
}
