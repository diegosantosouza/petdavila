<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\Tutor::class, function (Faker $faker) {
    return [
        'nome'=> $faker->name,
        'genero'=> $faker->randomElement($array = array ('Masculino','Feminino')),
        'cpf'=> $faker->randomNumber,
        'rg'=> $faker->randomNumber,
        'orgao_expedidor'=> $faker->randomElement($array = array ('SSP/SP','SSP/RJ')),
        'rua'=> $faker->streetName,
        'numero'=> $faker->buildingNumber,
        'complemento'=> $faker->randomElement($array = array ('sim','não')),
        'bairro'=> $faker->cityPrefix,
        'estado'=> $faker->randomElement($array = array ('SP','RJ', 'MG')),
        'cidade'=> $faker->randomElement($array = array ('São paulo','Guarulhos', 'São bernardo')),
        'telefone'=> $faker->randomNumber ,
        'celular'=> $faker->randomNumber,
        'email'=> $faker->freeEmail,
    ];
});
