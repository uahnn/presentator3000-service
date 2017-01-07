<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCodefragmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('codefragments', function (Blueprint $table) {
            $table->increments('id');
            $table->string('path');
            $table->string('ref');
            $table->integer('line_start');
            $table->integer('line_end');
            $table->longText('cache');
            $table->timestamp('last_updated');

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
        Schema::dropIfExists('codefragments');
    }
}
