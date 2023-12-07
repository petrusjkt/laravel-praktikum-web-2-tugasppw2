<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Character;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Character>
 */
class CharacterFactory extends Factory
{

    protected $model = Character::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'game_series' => $this->faker->company(),
            'first_appearance_game' => $this->faker->company(),
            'first_appearance_year' => $this->faker->year(),
            'creator' => $this->faker->name(),
            'description' => $this->faker->realText(200),
            'abilities' => $this->faker->text(),
        ];
    }
}
