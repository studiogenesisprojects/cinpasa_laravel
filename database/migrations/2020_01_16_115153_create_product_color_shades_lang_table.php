<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductColorShadesLangTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_color_shades_lang', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->integer('language_id')->unsigned();
            $table->foreign('language_id')->references('id')->on('language');

            $table->bigInteger('product_color_shade_id')->unsigned();
            $table->foreign('product_color_shade_id')->references('id')->on('product_color_shades')->onDelete('cascade');

            $table->string('name', 255)->nullable();
            $table->string('slug');
            $table->string('description')->nullable();

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
        Schema::dropIfExists('product_color_shades_lang');
    }
}