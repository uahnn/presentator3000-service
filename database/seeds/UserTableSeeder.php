<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        foreach (range(1, 30) as $index) {
            \App\User::create([
                'name'  => $faker->word,
                'email' => $faker->email,
                'password' =>  $faker->password,
                'userspace' => $faker->domainWord,
                'activation_code' => $faker->words(3, true)
            ]);
        }
    }
}
