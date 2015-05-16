<?php

use Illuminate\Database\Seeder;
use Pop\AttributeValue;
use Pop\Attribute;

class AttributeValueTableSeeder extends Seeder {

    public function run()
    {
        $faker = Faker\Factory::create();

        $clothesSizes = ['S', 'M', 'L', 'XL', 'XXL'];
        $shoeSizes = ['UK 6', 'UK 6.5', 'UK 7', 'UK 7.5', 'UK 8', 'UK 8.5', 'UK 9', 'UK 10'];

        $clothesAttr = Attribute::where('code', '=', 'clothes_sizes')->first();
        $shoesAttr = Attribute::where('code', '=', 'shoes_sizes')->first();

        foreach($clothesSizes as $size) {
            AttributeValue::create([
                'attribute_id' => $clothesAttr->id,
                'name' => $size
            ]);
        }

        foreach($shoeSizes as $size) {
            AttributeValue::create([
                'attribute_id' => $shoesAttr->id,
                'name' => $size
            ]);
        }
    }
}