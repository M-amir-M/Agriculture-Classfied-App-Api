<?php

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

$factory->define(App\User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'thumbnail' => $faker->imageUrl(200,200,'business'),
        'email' => $faker->unique()->safeEmail,
        'mobile' => $faker->unique()->e164PhoneNumber,
        'password' => bcrypt('123456'), // secret
        'remember_token' => str_random(10),
        'api_token' => str_random(50),
    ];
});


$factory->define(App\Post::class, function (Faker $faker) {
    return [
        'category_id' => 1,
        'title' => $faker->name(),
        'description' => $faker->sentence(),
        'expected_price' => rand(20000,1000000),
    ];
});


$factory->define(App\PostImage::class, function (Faker $faker) {
    return [
        'image' => $faker->imageUrl(),
    ];
});
