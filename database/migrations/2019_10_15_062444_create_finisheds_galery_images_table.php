<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFinishedsGaleryImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('finisheds_galery_images', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('galery_id')->unsigned();
            $table->foreign('galery_id')->references('id')->on('finisheds_galery');
            $table->string('image', 255)->nullable();
            $table->string('alt_image', 255)->nullable();
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
        Schema::dropIfExists('finisheds_galery_images');
    }
}
