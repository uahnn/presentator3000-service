<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChannelPresentationJoinTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('channel_presentation', function (Blueprint $table) {
            $table->integer('channel_id')->unsigned();
            $table->integer('presentation_id')->unsigned();
            $table->integer('presentation_prev')->unsigned();
            $table->integer('presentation_next')->unsigned();
            $table->timestamps();

            $table->primary(['channel_id', 'presentation_id']);

            $table->foreign('channel_id')->references('id')->on('channels')->onDelete('cascade');
            $table->foreign('presentation_id')->references('id')->on('presentations')->onDelete('cascade');
            $table->foreign('presentation_prev')->references('id')->on('presentations')->onDelete('cascade');
            $table->foreign('presentation_next')->references('id')->on('presentations')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('channel_presentation');
    }
}
