<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        App\User::truncate();
        App\Slide::truncate();
        App\Presentation::truncate();
        App\Comment::truncate();
        DB::table('presentation_slide')->truncate();
        DB::table('channel_presentation')->truncate();
        App\Attachement::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        $this->call(UserTableSeeder::class);
        $this->call(SlidesTableSeeder::class);
        $this->call(PresentationsTableSeeder::class);
        $this->call(PresentationSlideTableSeeder::class);
        $this->call(CommentsTableSeeder::class);
        $this->call(TemplatesTableSeeder::class);
        $this->call(ChannelsTableSeeder::class);
        $this->call(ChannelPresentationTableSeeder::class);
        $this->call(AttachementsTableSeeder::class);
    }
}
