<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use Faker\Generator as Faker;
use App\Models\Employee;
use App\Models\EmploymentType;
use App\Models\JobDescription;

$factory->define(\App\Models\Employee::class, function (Faker $faker) {
    return [
        'first_name' => $faker->firstName,
        'middle_name' => $faker->optional(0.9)->firstName,
        'last_name' => $faker->lastName,
        'employee_id' => $faker->unique()->randomNumber(6),
        'onboarding_in_progress' => $faker->boolean,
        'salary' => $faker->randomFloat(2, 25000, 150000),
        'job_description_id' => JobDescription::inRandomOrder()->value('id'),
        'employment_type_id' => EmploymentType::inRandomOrder()->value('id'),
        'created_at' => $faker->dateTimeThisDecade(),
        'updated_at' => $faker->dateTimeThisDecade(),
        'deleted_at' => $faker->optional(0.01)->dateTimeThisDecade(),
    ];
});
