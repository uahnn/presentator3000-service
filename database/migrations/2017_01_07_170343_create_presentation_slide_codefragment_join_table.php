<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePresentationSlideCodefragmentJoinTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('presentation_slide_codefragment', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('presentation_id')->unsigned();
            $table->integer('slide_id')->unsigned();
            $table->integer('codefragment_id')->unsigned();

            $table->foreign(['presentation_id', 'slide_id'])->references(['presentation_id', 'slide_id'])->on('presentation_slide')->onDelete('cascade');
            $table->foreign('codefragment_id')->references('id')->on('codefragments')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('presentation_slide_codefragment');
    }
}
