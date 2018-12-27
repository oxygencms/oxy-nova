<?php

use Faker\Generator as Faker;

$factory->define(Oxygencms\OxyNova\Models\Page::class, function (Faker $faker) {
    return [
        'name' => $pageName = $faker->unique()->word,
        'slug' => [
            'en' => str_slug($pageName),
            'bg' => str_slug($pageName),
        ],
        'title' => [
            'en' => ucfirst($pageName),
            'bg' => ucfirst($pageName),
        ],
        'summary' => [
            'en' => $faker->words(6, true),
            'bg' => $faker->words(6, true),
        ],
        'body' => [
            'en' => $faker->words(23, true),
            'bg' => $faker->words(23, true),
        ],
    ];
});
