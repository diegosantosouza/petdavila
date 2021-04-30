<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\Anamnese::class, function (Faker $faker) {
    return [
        'queixa'=>$faker->sentence($nbWords = 6, $variableNbWords = true),
        'estado_geral'=>$faker->randomElement($array = array ('bom','regular','ruim')),
        'peso'=>$faker->randomFloat($nbMaxDecimals = 2, $min = 1, $max = 30),
        'temperatura'=>$faker->randomFloat($nbMaxDecimals = 2, $min = 30, $max = 40),
        'frequencia_cardiaca'=>$faker->numberBetween($min = 60, $max = 150),
        'frequencia_respiratoria'=>$faker->numberBetween($min = 30, $max = 80),
        'mucosas'=>$faker->randomElement($array = array ('bom','regular','ruim')),
        't_p_capilar'=>$faker->numberBetween($min = 1, $max = 5),
        'hidratacao'=>$faker->randomElement($array = array ('bom','regular','ruim')),
        'linfonodos'=>$faker->randomElement($array = array ('Submandibulares',' Pré-escapulares','Poplíteos')),
        'tegumentos'=>$faker->randomElement($array = array ('bom','regular','ruim')),
        'sis_digestorio'=>$faker->randomElement($array = array ('bom','regular','ruim')),
        'sis_genito_urinario'=>$faker->randomElement($array = array ('bom','regular','ruim')),
        'sis_locomotor'=>$faker->randomElement($array = array ('bom','regular','ruim')),
        'sis_neurologico'=>$faker->randomElement($array = array ('bom','regular','ruim')),
        'sis_cardiologico'=>$faker->randomElement($array = array ('bom','regular','ruim')),
        'alimentacao'=>$faker->randomElement($array = array ('bom','regular','ruim')),
        'ectoparasitos'=>$faker->randomElement($array = array ('bom','regular','ruim')),
        'vermifugacao'=>$faker->randomElement($array = array ('sim','não')),
        'banhos'=>$faker->randomElement($array = array ('sim','não')),
        'suspeita_diagnostica'=>$faker->randomElement($array = array ('sim','não')),
        'solicitacao_exames'=>$faker->randomElement($array = array ('sim','não')),
        'tratamento'=>$faker->randomElement($array = array ('sim','não')),
        'valor'=>$faker->randomElement($array = array ('100', '200', '300', '350', '400', '450')),
        'arquivos'=>$faker->randomElement($array = array ('sim','não')),
        'id_animal'=>$faker->numberBetween($min = 1, $max = 50)

        ];
    });


