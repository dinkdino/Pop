<?php

use Illuminate\Database\Seeder;
use Pop\Attribute;
use Pop\Category;

class CategoryAttributeTableSeeder extends Seeder {

    public function run()
    {
        $faker = Faker\Factory::create();

        $clothesCatNames = ["Tops", "Bottoms", "Underwear", "Outerwear"];
        $clothesCats = Category::whereIn('name', $clothesCatNames)->get();

        $clothesAttr = Attribute::where('code', 'clothes_sizes')->first();
        $shoesAttr = Attribute::where('code', 'shoes_sizes')->first();
        $shoesCat = Category::whereIn('name', ['Shoes'])->get();

        foreach($clothesCats as $cat) {
            DB::table('categories_attributes')->insert([
                'category_id' => $cat->id,
                'attribute_id' => $clothesAttr->id
            ]);
        }


        foreach($shoesCat as $cat) {
            DB::table('categories_attributes')->insert([
                'category_id' => $cat->id,
                'attribute_id' => $shoesAttr->id
            ]);
        }
    }
}