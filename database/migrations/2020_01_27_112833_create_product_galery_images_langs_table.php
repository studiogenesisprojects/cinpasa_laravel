<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductGaleryImagesLangsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_galery_image_langs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();

            $table->unsignedInteger('language_id')->nullable();
            $table->foreign('language_id')->references('id')->on('language');

            $table->unsignedBigInteger('product_galery_image_id')->nullable();
            $table->foreign('product_galery_image_id')->references('id')->on('product_galery_images');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_galery_images_langs');
    }
}
