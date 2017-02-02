<?php

use App\User;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;


class ChannelsTableSeeder extends Seeder
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

        foreach (range(1, 20) as $index) {
            \App\Channel::create([
                'user_id' => $faker->randomElement($userIds),
                'title' => $faker->sentence(5),
                'description' => $faker->paragraph(5)
            ]);
        }
    }
}
