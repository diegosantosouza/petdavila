<?php

namespace Database\Factories;

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\Animal::class, function (Faker $faker) {
    return [
        'nome_animal'=> $faker->name,
        'especie'=> $faker->randomElement($array = array ('canino','felino')),
        'raca'=> $faker->randomElement($array = array ('spitz','pastor','shitzu','buldog')),
        'sexo'=> $faker->randomElement($array = array ('macho','femea')),
        'idade'=> $faker->numberBetween($min = 1, $max = 15),
        'castrado'=> $faker->randomElement($array = array ('sim','não')),
        'observacoes'=> $faker->paragraph,
        'tutor_n'=> $faker->numberBetween($min = 1, $max = 20),

        ];
});
