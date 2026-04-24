<?php

namespace Database\Seeders;

use App\Models\UserCompetence;
use Illuminate\Database\Seeder;

class UserCompetenceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        UserCompetence::factory(100)->create();
    }
}
