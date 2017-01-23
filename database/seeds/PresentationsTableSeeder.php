<?php

use App\User;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class PresentationsTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();
        $userIds = User::pluck('id')->toArray();

        foreach (range(1, 10) as $index) {
            \App\Presentation::create([
                'user_id' => $faker->randomElement($userIds),
                'title' => $faker->sentence(10),
                'description' => $faker->paragraph(5)
            ]);
        }
    }
}