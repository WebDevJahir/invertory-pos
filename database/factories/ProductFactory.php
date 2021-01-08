<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {

    return [
        'supplier_id' => $faker->randomDigitNotNull,
        'unit_id' => $faker->randomDigitNotNull,
        'category_id' => $faker->randomDigitNotNull,
        'product_name' => $faker->randomDigitNotNull,
        'quantity' => $faker->randomDigitNotNull,
        'status' => $faker->word,
        'deleted_at' => $faker->date('Y-m-d H:i:s'),
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
