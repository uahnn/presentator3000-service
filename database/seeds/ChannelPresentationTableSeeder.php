<?php

use App\Channel;
use App\Presentation;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class ChannelPresentationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        $presentationsIds = Presentation::pluck('id')->toArray();

        foreach (range(1, 15) as $i) {
            shuffle($presentationsIds);
            $channelIds = Channel::pluck('id')->toArray();
            foreach (range(1, 15) as $j){
                shuffle($channelIds);
                DB::table('channel_presentation')->insert([
                    'channel_id' => array_pop($channelIds),
                    'presentation_id' => last($presentationsIds),
                    'presentation_prev' => null,
                    'presentation_next' => null
                ]);
            }
            array_pop($presentationsIds);
        }
    }
}
