<?php
use Illuminate\Database\Seeder;
use Pop\User;

class UserTableSeeder extends Seeder {

    public function run() {

        $faker = Faker\Factory::create();

        // Main test user
        User::create([
            'first_name' => "Hrishikesh",
            'last_name'  => "Sawant",
            'email'      => "hrishikeshsawant@hotmail.com",
            'password'   => bcrypt("chocopie")
        ]);

        foreach(range(1, 10) as $index) {

            User::create([
                'first_name' => $faker->firstName,
                'last_name'  => $faker->lastName,
                'email'      => $faker->unique()->email,
                'password'   => bcrypt($faker->password())
            ]);
        }

    }
}