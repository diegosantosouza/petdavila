<?php

namespace Database\Factories;

use App\Models\Donos;
use Illuminate\Database\Eloquent\Factories\Factory;

class DonosFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    protected $model = Donos::class;

    public function definition()
    {
        return [
            'nome'=> $this->faker->name,
            'telefone'=> $this->faker->numberBetween($min = 11111111111, $max = 99999999999),
            'cpf'=> $this->faker->numberBetween($min = 11111111111, $max = 99999999999),
        ];
    }
}
