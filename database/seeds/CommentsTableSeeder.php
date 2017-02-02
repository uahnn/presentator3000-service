<?php

use App\Slide;
use App\User;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class CommentsTableSeeder extends Seeder
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
        $slideIds = Slide::pluck('id')->toArray();

        foreach (range(1, 30) as $index) {
            \App\Comment::create([
                'slide_id' => $faker->randomElement($slideIds),
                'user_id' => $faker->randomElement($userIds),
                'content' => $faker->paragraph(5)
            ]);
        }
    }
}
