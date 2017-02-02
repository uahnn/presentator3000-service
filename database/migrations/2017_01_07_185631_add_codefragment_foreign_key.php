<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCodefragmentForeignKey extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('codefragments', function (Blueprint $table) {
            $table->integer('codebase_id')->unsigned()->nullable()->default(null);;
            $table->foreign('codebase_id')->references('id')->on('codebases');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('codefragments', function (Blueprint $table) {
            $table->dropForeign('codefragments_codebase_id_foreign');
            $table->dropColumn('codebase_id');
        });
    }
}
