<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Atleta;
use Faker\Generator as Faker;

$factory->define(Atleta::class, function (Faker $faker) {
    return [
        'nombre' => $faker->firstName,
        'apellido' => $faker->lastName,
        'cedula' => $faker->unique()->randomNumber($nbDigits = 8),
        'pasaporte' => $faker->unique()->randomNumber($nbDigits = 9),
        'nacionalidad' => $faker->randomElement($array = array ('V','E')),
        'correo' => $faker->unique()->safeEmail,
        'twitter' => '@example',
        'municipio' => $faker->state,
        'parroquia' => $faker->city,
        'telefono_movil' => $faker->unique()->randomNumber($nbDigits = 9),
        'telefono_casa' => $faker->randomNumber($nbDigits = 9),
        'pnf_id' => $faker->numberBetween(1,9),
        'lapso_inscripcion' => $faker->randomElement($array = array ('2020-01','2018-02','2019-01')),
        'disciplina_id' => $faker->numberBetween(1,5),
        'fecha_nacimiento' => $faker->date(),
        'lugar_nacimiento' => $faker->city,
        'tipo_sangre' => $faker->randomElement($array = array ('A+','O+','O-', 'B+')),
        'estatura' => $faker->randomElement($array = array ('1.60m','1.87m','1.70m')),
        'talla_zapato' => $faker->numberBetween(36,44),
        'talla_franela' => $faker->randomElement($array = array ('S','M','L', 'XL', 'XXL')),
        'talla_short' => $faker->numberBetween(36,44),
        'peso' => $faker->randomElement($array = array ('60k','85k','90k', '55k')),
        'direccion' => $faker->address,
        'observaciones' => $faker->text,
        'foto_carnet' => $faker->randomElement($array = array (
            '/assets/images/users/1.jpg','/assets/images/users/2.jpg',
            '/assets/images/users/3.jpg', '/assets/images/users/4.jpg',
            '/assets/images/users/5.jpg', '/assets/images/users/6.jpg',
            '/assets/images/users/7.jpg', '/assets/images/users/8.jpg'
        ))
    ];
});
