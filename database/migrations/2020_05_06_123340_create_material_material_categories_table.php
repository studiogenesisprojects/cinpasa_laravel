<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMaterialMaterialCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('material_material_categories', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('material_category_id');
            $table->foreign('material_category_id')->references('id')->on('material_categories');

            $table->unsignedBigInteger('material_id');
            $table->foreign('material_id')->references('id')->on('materials');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('material_material_categories');
    }
}
