<?php

use App\BlogPost;
use Faker\Generator as Faker;

$factory->define(BlogPost::class, function (Faker $faker) {
    return [
        'title'       => $faker->sentence(),
        'body'        => $faker->paragraphs(random_int(2, 6), true),
        'released_at' => $faker->dateTimeThisDecade('+1 year'),
    ];
});
