<?php

use Faker\Generator as Faker;

$factory->define(Oxygencms\OxyNova\Models\PageSection::class, function (Faker $faker) {
    $data = [
        'name' => $faker->unique()->word,
        'body' => [
            'en' => $words = $faker->words(10, true),
            'bg' => $words,
        ],
        'page_id' => function () {
            return factory(\Oxygencms\OxyNova\Models\Page::class)->create();
        }
    ];

    return $data;
});
