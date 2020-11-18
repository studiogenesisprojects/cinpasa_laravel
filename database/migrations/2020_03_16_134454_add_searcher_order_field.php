<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSearcherOrderField extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('materials', function (Blueprint $table) {
            $table->integer('searcher_order')->nullable();
        });

        Schema::table('product_color_shades', function (Blueprint $table) {
            $table->integer('searcher_order')->nullable();
        });

        Schema::table('product_categories', function (Blueprint $table) {
            $table->integer('searcher_order')->nullable();
        });

        Schema::table('products_forms', function (Blueprint $table) {
            $table->integer('searcher_order')->nullable();
        });

        Schema::table('products_braideds', function (Blueprint $table) {
            $table->integer('searcher_order')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
