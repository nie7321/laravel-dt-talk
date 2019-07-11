<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use Faker\Generator as Faker;

$factory->define(\App\Models\JobDescription::class, function (Faker $faker) {
    return [
        'title' => $faker->jobTitle,
        'duties' => $faker->paragraphs(3, true),
        'created_at' => $faker->dateTimeThisDecade(),
        'updated_at' => $faker->dateTimeThisDecade(),
        'deleted_at' => $faker->optional(0.01)->dateTimeThisDecade(),
    ];
});
