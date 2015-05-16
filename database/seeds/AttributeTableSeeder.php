<?php


use Illuminate\Database\Seeder;
use Pop\Attribute;

class AttributeTableSeeder extends Seeder {

    public function run()
    {
        $attrs = [
            'clothes' => [
                'name' => 'Size',
                'code' => 'clothes_sizes'
            ],
            'shoes' => [
                'name' => 'Size',
                'code' => 'shoes_sizes'
            ]
        ];

        foreach($attrs as $attr) {
            Attribute::create([
                'name' => $attr['name'],
                'code' => $attr['code']
            ]);
        }
    }
}