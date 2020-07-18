<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Category;
use Faker\Generator as Faker;
use Illuminate\Support\Str as Str;


$factory->define(Category::class, function (Faker $faker) {
    if(Category::all()->count() == 0 || $faker->boolean(10)) $parent_id = null;
    else $parent_id = Category::all()->random()->id;
    $name =  $faker->unique()->words(rand(1, 2), true);

    return [
        'name' => $name,
        'slug' => Str::slug($name),
        'image'=> $faker->imageUrl(),
        'parent_id' => $parent_id
    ];
});
