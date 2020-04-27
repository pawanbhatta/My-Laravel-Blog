<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Post;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    return [
        'title'=>$faker->word,
        'desc'=>$faker->text,
        'image'=>$faker->imageUrl($width = 640, $height = 480)
    ];
});