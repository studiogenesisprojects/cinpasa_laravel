<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductColorsCategoriesRelated extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_color_product_color_category', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreign('product_color_id', 'pc_fk')->references('id')->on('product_colors')->onDelete('cascade');
            $table->bigInteger('product_color_id')->unsigned();
            $table->foreign('product_color_category_id', 'pc_c_fk')->references('id')->on('product_color_categories')->onDelete('cascade');
            $table->bigInteger('product_color_category_id')->unsigned();
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
        Schema::dropIfExists('product_colors_categories_related');
    }
}
