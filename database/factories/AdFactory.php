<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Ad;
use App\User;
use App\Category;
use Faker\Generator as Faker;use Illuminate\Support\Str as Str;


$factory->define(Ad::class, function (Faker $faker) {
    for ($i = 0; $i < rand(1, 5); $i++) $images[$i] = $faker->imageUrl(400, 400);
    $name =  $faker->unique()->words(rand(2, 3), true);

    return [

        'name' => $name,
        'slug' => Str::slug($name),
        'images' => json_encode($images),
        'price' => $faker->randomFloat(2, 0.01, 10000),
        'description' => $faker->realText(1000),
        'location' => $faker->address(),
        'category_id' => Category::all()->random()->id,
        'user_id' => User::all()->random()->id

    ];
});
