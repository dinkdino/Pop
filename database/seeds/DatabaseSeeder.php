<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Pop\Attribute;
use Pop\AttributeValue;
use Pop\Product;
use Pop\User;
use Pop\Category;

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
        $this->clean();

		Model::unguard();

        $this->call('UserTableSeeder');
        $this->call('ProductTableSeeder');
        $this->call('CategoryTableSeeder');
        $this->call('AttributeTableSeeder');
        $this->call('CategoryAttributeTableSeeder');
        $this->call('AttributeValueTableSeeder');
	}

    public function clean()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        User::truncate();
        Product::truncate();
        Category::truncate();
        Attribute::truncate();
        DB::table('categories_attributes')->truncate();
        AttributeValue::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }

}
