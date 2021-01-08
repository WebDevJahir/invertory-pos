<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Perchase;
use Faker\Generator as Faker;

$factory->define(Perchase::class, function (Faker $faker) {

    return [
        'supplier_id' => $faker->randomDigitNotNull,
        'unit_id' => $faker->randomDigitNotNull,
        'category_id' => $faker->randomDigitNotNull,
        'product_id' => $faker->randomDigitNotNull,
        'purchase_no' => $faker->word,
        'date' => $faker->word,
        'description' => $faker->word,
        'buying_qty' => $faker->randomDigitNotNull,
        'unit_price' => $faker->randomDigitNotNull,
        'buying_price' => $faker->randomDigitNotNull,
        'status' => $faker->word,
        'deleted_at' => $faker->date('Y-m-d H:i:s'),
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
