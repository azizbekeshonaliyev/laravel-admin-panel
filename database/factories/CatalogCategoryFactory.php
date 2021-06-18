<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Auth\User;
use Faker\Generator as Faker;

$factory->define(\Domain\Catalog\Entities\CatalogCategory::class, function (Faker $faker) {
    return [
        'active' => $faker->boolean,
        'created_by' => function () {
            return factory(User::class)->state('active')->create()->id;
        },
    ];
});
