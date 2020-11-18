<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductColorCategoryLangsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_color_category_langs', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->integer('language_id')->unsigned();
            $table->foreign('language_id')->references('id')->on('language')->onDelete('cascade');

            $table->bigInteger('product_color_category_id')->unsigned();
            $table->foreign('product_color_category_id')->references('id')->on('product_color_categories')->onDelete('cascade');

            $table->string('name', 255);
            $table->string('slug');
            $table->string('description');
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
        Schema::dropIfExists('product_color_category_langs');
    }
}
