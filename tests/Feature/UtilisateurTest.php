<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
// use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UtilisateurTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    protected function setUp(): void
        {
            parent::setUp();
            // $this->seed(); // Seed the database before each test
        }

    public function testUtilisateurList(): void
    {
        $response = $this->get('/api/utilisateurs');

        $response->assertStatus(200);
    }
}
