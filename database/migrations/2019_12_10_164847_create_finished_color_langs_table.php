<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFinishedColorLangsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('finished_color_langs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();

            $table->string("name");

            $table->unsignedBigInteger('finished_color_id')->unsigned();
            $table->foreign('finished_color_id')->references('id')->on('finished_colors')->onDelete('cascade');

            $table->integer('language_id')->unsigned();
            $table->foreign('language_id')->references('id')->on('language')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('finished_color_langs');
    }
}
