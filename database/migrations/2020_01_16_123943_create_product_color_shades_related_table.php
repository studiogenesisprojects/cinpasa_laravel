<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductColorShadesRelatedTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_color_shades_related', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('product_color_shade_id')->unsigned();
            $table->foreign('product_color_shade_id')->references('id')->on('product_color_shades')->onDelete('cascade');

            $table->unsignedBigInteger('product_color_id')->unsigned();
            $table->foreign('product_color_id')->references('id')->on('product_colors')->onDelete('cascade');

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
        Schema::dropIfExists('product_color_shades_related');
    }
}