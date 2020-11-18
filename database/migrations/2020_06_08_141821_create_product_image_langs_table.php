<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductImageLangsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_image_langs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();

            $table->integer('language_id')->unsigned();
            $table->foreign('language_id')->references('id')->on('language');

            $table->bigInteger('product_image_id')->unsigned();
            $table->foreign('product_image_id')->references('id')->on('product_images')->onDelete('cascade');

            $table->string('alt')->nullable();
        });

        if (!Schema::hasColumn('product_galery_image_langs', 'alt')) {
            Schema::table('product_galery_image_langs', function (Blueprint $table) {
                $table->string('alt')->nullable();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_image_langs');
    }
}
