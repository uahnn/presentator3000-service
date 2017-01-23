<?php

use App\Presentation;
use App\Slide;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class PresentationSlideTableSeeder extends Seeder
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

        foreach (range(1, 7) as $i) {
            shuffle($presentationsIds);
            $slidesIds = Slide::pluck('id')->toArray();
            foreach (range(1, 10) as $j){
                shuffle($slidesIds);
                DB::table('presentation_slide')->insert([
                    'slide_id' => array_pop($slidesIds),
                    'presentation_id' => last($presentationsIds),
                    'slide_prev' => null,
                    'slide_next' => null
                ]);
            }
            array_pop($presentationsIds);
        }
    }
}
