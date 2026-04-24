<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
// use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CompetenceTest extends TestCase
{
    use RefreshDatabase;
        /**
        * Set up the test environment.
        */
        protected function setUp(): void
        {
            parent::setUp();
            // $this->seed(); // Seed the database before each test
        }

    /**
     * A basic feature test example.
     */
    public function testCompetenceList(): void
    {

        $response = $this->get('/api/competences');

        $response->assertStatus(200);
        $response=$this->delete('api/competences/{$competence->code_comp}');
        
    }
}
