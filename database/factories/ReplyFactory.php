<?php

use Faker\Generator as Faker;
use App\Models\User;
use App\Models\Topic;

$factory->define(App\Models\Reply::class, function (Faker $faker) {

    $time = $faker->dateTimeThisMonth();

    // 所有用户 ID 数组，如：[1,2,3,4]
    $user_ids = User::all()->pluck('id')->toArray();

    // 所有话题 ID 数组，如：[1,2,3,4]
    $topic_ids = Topic::all()->pluck('id')->toArray();

    return [
        // 'name' => $faker->name,
        'content' => $faker->sentence(),
        'created_at' => $time,
        'updated_at' => $time,
        'user_id' => $faker->randomElement($user_ids),
        'topic_id' => $faker ->randomElement($topic_ids),
    ];
});
