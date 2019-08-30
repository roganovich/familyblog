<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\User;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(\App\Models\Blog\Category::class, function (Faker $faker) {
    $title = $faker->sentence(rand(1, 3));
    $isPublished = (rand(1,5)>1);
    $created_at = $faker->dateTimeBetween('-3 months', '-2 months');
    return [
        'title' => $title,
        'slug' => Str::slug($title),
        'is_published' => $isPublished,
        'created_at' => $created_at,
        'updated_at' => $created_at,
    ];
});

