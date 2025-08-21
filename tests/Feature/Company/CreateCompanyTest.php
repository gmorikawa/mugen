<?php

namespace Tests\Feature\Company;

use App\Models\Company;
use Tests\TestCase;

class CreateCompanyTest extends TestCase
{
    public function test_creates_company(): void
    {
        $company = Company::factory()->makeOne();

        $response = $this
            ->post('/api/companies', $company->toArray())
            ->assertStatus(201);

        $created = $response->decodeResponseJson();

        $this->assertNotEmpty($created['id']);
        $this->assertEquals($company->name, $created['name']);
        $this->assertEquals($company->description, $created['description']);
        $this->assertEquals($company->country_id, $created['country_id']);
    }
}
