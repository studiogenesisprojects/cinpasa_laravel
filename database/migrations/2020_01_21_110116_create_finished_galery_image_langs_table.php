<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFinishedGaleryImageLangsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('finished_galery_image_langs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->unsignedBigInteger('finished_galery_image_id');
            $table->foreign('finished_galery_image_id')->references('id')->on('finisheds_galery_images')->onDelete('cascade');

            $table->unsignedInteger('language_id');
            $table->foreign('language_id')->references('id')->on('language')->onDelete('cascade');

            $table->string('alt')->nullable();
            $table->string('name')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('finished_galery_image_langs');
    }
}
