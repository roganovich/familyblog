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

$factory->define(\App\Models\Blog\Post::class, function (Faker $faker) {
    $title = $faker->sentence(rand(3, 9));
    $text = $faker->realText(rand(1000, 4000));
    $isPublished = (rand(1,5)>1);
    $created_at = $faker->dateTimeBetween('-3 months', '-2 months');
    return [
        'author_id'=>rand(1,2),
        'title' => $title,
        'slug' => Str::slug($title),
        'intro_html' => Str::limit($text,100),
        'content_html' => $text,
        'is_published' => $isPublished,
        'published_at' => ($isPublished)?$faker->dateTimeBetween('-2 months', '-1 days'):null, 
        'created_at' => $created_at,
        'updated_at' => $created_at,
    ];
});

