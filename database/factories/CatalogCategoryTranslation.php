<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Domain\Catalog\Entities\CatalogCategoryTranslation;
use Faker\Generator as Faker;

$factory->define(CatalogCategoryTranslation::class, function (Faker $faker) {
    return [
        'locale' => 'en',
        'name' => $faker->words(3, true),
        'desc' => $faker->text(2000),
    ];
});
