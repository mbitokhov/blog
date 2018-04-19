<?php

use App\User;
use App\Comment;
use App\BlogPost;
use Faker\Generator as Faker;

$factory->define(Comment::class, function (Faker $faker) {
    return [
        'body' => $faker->sentences(3, true),
        'display_name' => $faker->name(),
        'blog_post_id' => BlogPost::inRandomOrder()->first(['id'])->id
    ];
});
