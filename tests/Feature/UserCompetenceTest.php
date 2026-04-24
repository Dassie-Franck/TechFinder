<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
// use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserCompetenceTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    protected function setUp(): void
        {
            parent::setUp();
            // $this->seed(); // Seed the database before each test
        }

    public function testUserCompetenceList(): void
    {
        $response = $this->get('/api/usercompetences');

        $response->assertStatus(200);
    }
}
