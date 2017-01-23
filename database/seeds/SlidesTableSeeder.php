<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class SlidesTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        foreach (range(1, 20) as $index) {
            \App\Slide::create([
                'content' => $faker->paragraph(5),
                'shared' => $faker->boolean()
            ]);
        }
    }
}