<?php

namespace Database\Factories;

use App\Models\Competence;
use App\Models\Utilisateur;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Intervention>
 */
class InterventionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
                'date_int' => $this->faker->date(),
                'note_int' => $this->faker->numberBetween(0, 20),
                'commentaire_int' => $this->faker->text(),
                'code_user_techn' =>Utilisateur::inRandomOrder()->value('code_user'),
                'code_user_client' => Utilisateur::inRandomOrder()->value('code_user'),
                'code_comp' => Competence::inRandomOrder()->value('code_comp'),
        ];
    }
}
