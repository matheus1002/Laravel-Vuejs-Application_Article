<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Artigo;
use Faker\Generator as Faker;

$factory->define(Artigo::class, function (Faker $faker) {
    return [
        'titulo' => $faker->text(50),
        'descricao' => $faker->text(200)
    ];
});
