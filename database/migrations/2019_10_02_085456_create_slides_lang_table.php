<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSlidesLangTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('slides_lang', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('language_id')->unsigned();
            $table->foreign('language_id')->references('id')->on('language');
            $table->bigInteger('slide_id')->unsigned();
            $table->foreign('slide_id')->references('id')->on('slides');
            $table->string('alt_img', 255)->nullable();
            $table->string('title_url', 255)->nullable();
            $table->string('title', 255)->nullable();
            $table->string('text', 255)->nullable();
            $table->boolean('active')->default(0);
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
        Schema::dropIfExists('slides_lang');
    }
}