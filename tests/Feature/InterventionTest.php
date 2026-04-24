<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
// use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class InterventionTest extends TestCase
{
    
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    protected function setUp(): void
        {
            parent::setUp();
             // Seed the database before each test
        }

    public function testInterventionList(): void
    {
        $response = $this->get('/api/interventions');

        $response->assertStatus(200);
    }
}
