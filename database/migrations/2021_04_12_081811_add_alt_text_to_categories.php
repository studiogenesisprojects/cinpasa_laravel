<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAltTextToCategories extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('product_category_langs', function (Blueprint $table) {
            $table->text('alt_text_image_1')->nullable();
            $table->text('alt_text_image_2')->nullable();
            $table->text('alt_text_image_3')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('product_category_langs', function (Blueprint $table) {
            //
        });
    }
}
