<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->boolean('active')->nullable()->default(true);
            $table->string('liasa_code', 255)->nullable();
            $table->string('video', 255)->nullable();
            $table->integer('order')->nullable();

            $table->bigInteger('category_id')->unsigned();
            $table->foreign('category_id')->references('id')->on('product_categories')->onDelete('cascade');

            $table->bigInteger('type_id')->unsigned()->nullable();
            $table->foreign('type_id')->references('id')->on('products_type')->onDelete('cascade');

            $table->bigInteger('form_id')->unsigned()->nullable();
            $table->foreign('form_id')->references('id')->on('products_forms')->onDelete('cascade');

            $table->bigInteger('brided_id')->unsigned()->nullable();
            $table->foreign('brided_id')->references('id')->on('products_braideds')->onDelete('cascade');

            $table->bigInteger('product_image_id')->unsigned()->nullable();
            $table->foreign('product_image_id')->references('id')->on('product_images');

            $table->timestamps();
        });

        Schema::table('product_images', function (Blueprint $table) {
            $table->bigInteger('product_id')->unsigned();
            $table->foreign('product_id')->references('id')->on('products');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
