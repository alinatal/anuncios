<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Sponsor;
use Faker\Generator as Faker;

$factory->define(Sponsor::class, function (Faker $faker) {
    $categories = \App\Category::all();
    if($faker->boolean(98)){
        $zone = 'categories.'. $categories->random()->slug;
    }
    else{
        $zone = $faker->randomElement(['carousel', 'ads']);
    }

    if($zone == 'carousel'){
        $image = $faker->imageUrl(1200, 400);
    }
    else if($zone == 'ads'){
        $image = $faker->imageUrl(1000, 400);
    }
    else $image = $faker->imageUrl(1000, 400);
    return [
        'name' => $faker->unique()->words(rand(2, 3), true),
        'description' => $faker->realText(45),
        'link' => $faker->url,
        'image' => $faker->randomElement([$image, null]),
        'image_sm' => $faker->randomElement([$image, null]),
        'zone' => $zone,
        'alternative' => $faker->boolean(20)

    ];
});
