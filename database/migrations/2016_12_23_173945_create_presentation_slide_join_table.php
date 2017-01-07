<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePresentationSlideJoinTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('presentation_slide', function (Blueprint $table) {
            $table->integer('presentation_id')->unsigned();
            $table->integer('slide_id')->unsigned();
            $table->integer('slide_prev')->unsigned();
            $table->integer('slide_next')->unsigned();
            $table->timestamps();

            $table->primary(['presentation_id', 'slide_id']);

            $table->foreign('presentation_id')->references('id')->on('presentations')->onDelete('cascade');
            $table->foreign('slide_id')->references('id')->on('slides')->onDelete('cascade');
            $table->foreign('slide_prev')->references('id')->on('slides')->onDelete('cascade');
            $table->foreign('slide_next')->references('id')->on('slides')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('presentation_slide');
    }
}
