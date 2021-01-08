<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Invoice;
use Faker\Generator as Faker;

$factory->define(Invoice::class, function (Faker $faker) {

    return [
        'invoice_no' => $faker->word,
        'date' => $faker->word,
        'description' => $faker->text,
        'status' => $faker->word,
        'created_by' => $faker->randomDigitNotNull,
        'approved_by' => $faker->randomDigitNotNull,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
