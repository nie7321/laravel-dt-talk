<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use Faker\Generator as Faker;

$factory->define(\App\Models\EmploymentType::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'tax_code' => strtoupper($faker->randomLetter()),
        'created_at' => $faker->dateTimeThisDecade(),
        'updated_at' => $faker->dateTimeThisDecade(),
        'deleted_at' => null,
    ];
});
