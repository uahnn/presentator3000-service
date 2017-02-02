<?php

use App\Presentation;
use App\User;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class AttachementsTableSeeder extends Seeder
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
        $presentationIds = Presentation::pluck('id')->toArray();

        foreach (range(1, 30) as $index) {
            \App\Attachement::create([
                'presentation_id' => $faker->randomElement($presentationIds),
                'user_id' => $faker->randomElement($userIds),
                'filename' => substr(md5($faker->name.$faker->firstNameFemale), 0, $faker->numberBetween(8, 16)).'.'.$faker->fileExtension()
            ]);
        }
    }
}
