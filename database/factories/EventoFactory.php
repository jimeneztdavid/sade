<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Evento;
use Faker\Generator as Faker;

$factory->define(Evento::class, function (Faker $faker) {
    return [
        'fecha' => $faker->date(),
        'descripcion' => $faker->text($maxNbChars = 150),
        'disciplina_id' => $faker->randomElement($array = array (1,2,3,4,5)),
        'categoria_id' => $faker->randomElement($array = array (1,2,3,4)),
    ];
});
