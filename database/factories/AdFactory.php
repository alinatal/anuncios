<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Ad;
use App\User;
use App\Category;
use Faker\Generator as Faker;use Illuminate\Support\Str as Str;


$factory->define(Ad::class, function (Faker $faker) {
    for ($i = 0; $i < rand(1, 5); $i++) $images[$i] = $faker->imageUrl(400, 400);
    $name =  $faker->unique()->words(rand(2, 3), true);
    $leafs = Category::whereIsLeaf()->get();
    $category = $leafs[rand(0, $leafs->count()-1)]->id;

    return [

        'name' => $name,
        'slug' => Str::slug($name),
        'images' => json_encode($images),
        'price' => $faker->randomFloat(2, 0.01, 10000),
        'description' => $faker->realText(1000),
        'location' => $faker->address(),
        'category_id' => $category,
        'user_id' => User::all()->random()->id,
        'ip' => $faker->ipv4,
        'seller_type' => $faker->randomElement(['particular', 'profesional'])
    ];
});
