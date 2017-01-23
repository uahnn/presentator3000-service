<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCodefragmentSlideJoinTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('codefragment_slide', function (Blueprint $table) {
            $table->integer('slide_id')->unsigned();
            $table->integer('codefragment_id')->unsigned();

            $table->primary(['codefragment_id', 'slide_id']);
            $table->foreign('slide_id')->references('id')->on('slides');
            $table->foreign('codefragment_id')->references('id')->on('codefragments');

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
        Schema::dropIfExists('codefragment_slide');
    }
}
