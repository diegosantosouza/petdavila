<?php

namespace Database\Factories;

use App\Models\Animais;
use Illuminate\Database\Eloquent\Factories\Factory;

class AnimaisFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    protected $model = Animais::class;

    public function definition()
    {
        return [
            'donos_id'=> $this->faker->numberBetween($min = 1, $max = 100),
            'nome'=> $this->faker->firstName,
            'raca'=> $this->faker->numberBetween($min = 11111111111, $max = 99999999999),
            'categoria_id'=> $this->faker->numberBetween($min = 1, $max = 3),
        ];
    }
}
