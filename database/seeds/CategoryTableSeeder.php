<?php


use Illuminate\Database\Seeder;
use Pop\Category;

class CategoryTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker\Factory::create();

        $categories = [
            'Menswear' => [
                'Tops',
                'Bottoms',
                'Underwear',
                'Outerwear',
                'Shoes',
                'Accessories'
             ],
            'Womenswear' => [
                'Tops',
                'Bottoms',
                'Dresses',
                'Lingerie',
                'Outerwear',
                'Shoes',
                'Accessories'
            ],
            'Jewellery',
            'Art',
            'Tech',
            'Books & magazines',
            'Music',
            'Film',
            'Home',
            'Kids',
            'Beauty',
            'Sports equipment',
            'Transportation',
            'Others'
        ];

        $this->createCategories($categories);
    }

    private function createCategories(array $categories, Category $parent = null) {

        foreach($categories as $key => $val) {

            if (is_array($val)) {
                $newCat = Category::create([
                    'name'  => $key
                ]);
                $this->createCategories($val, $newCat);
            } else {
                $newCat = Category::create([
                    'name'  => $val
                ]);

                if (!is_null($parent)) {
                    $newCat->parent()->associate($parent);
                    //$newCat->category_id = $parent->id;
                    $newCat->save();
                }
            }
        }
    }

}
