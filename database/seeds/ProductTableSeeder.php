<?php

use Illuminate\Database\Seeder;
use Pop\Product;

class ProductTableSeeder extends Seeder {

    public function run()
    {
        $faker = Faker\Factory::create();

        foreach(range(1, 30) as $index) {
            Product::create([
                'name'  => $faker->word,
                'description'  => $faker->paragraph(),
                'price' => $faker->randomFloat(2),
                'quantity' => $faker->randomDigitNotNull
            ]);
        }
    }
}