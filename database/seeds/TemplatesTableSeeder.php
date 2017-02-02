<?php

use App\User;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class TemplatesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        $userIds = User::pluck('id')->toArray();

        foreach (range(1, 15) as $index) {
            \App\Template::create([
                'user_id' => $faker->randomElement($userIds),
                'title' => $faker->sentence(3),
                'markup' => $faker->paragraph(5)
            ]);
        }
    }
}