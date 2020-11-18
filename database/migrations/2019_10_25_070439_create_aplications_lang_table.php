<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAplicationsLangTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aplications_lang', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();

            $table->integer('language_id')->unsigned();
            $table->foreign('language_id')->references('id')->on('language');

            $table->bigInteger('aplication_id')->unsigned();
            $table->foreign('aplication_id')->references('id')->on('aplications')->onDelete('cascade');

            $table->string('name');
            $table->string('slug');
            $table->string('subtitle', 255)->nullable();
            $table->string('lite_description', 160)->nullable();
            $table->text('description')->nullable();
            $table->string('image_alt', 255)->nullable();
            $table->integer('order')->nullable()->default(null);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('aplications_lang');
    }
}
