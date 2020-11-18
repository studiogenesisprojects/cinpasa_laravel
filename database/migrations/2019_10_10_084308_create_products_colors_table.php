<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsColorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_colors', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('pantone', 255);
            $table->string('rgb_color', 255)->nullable();
            $table->string('hex_color', 255)->nullable()->default('fff');
            $table->boolean('active')->nullable()->default(1);
            $table->timestamps();
        });

        Schema::create('product_color_langs', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('name', 255)->nullable();
            $table->string('slug');
            $table->string('description')->nullable();

            $table->bigInteger('product_color_id')->unsigned();
            $table->foreign('product_color_id')->references('id')->on('product_colors')->onDelete('cascade');

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
        Schema::dropIfExists('products_colors');
    }
}