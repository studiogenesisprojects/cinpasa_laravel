<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMaterialCategoryLangsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('material_category_langs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('material_category_id');
            $table->foreign('material_category_id')->references('id')->on('material_categories')->onDelete('cascade');
            $table->unsignedInteger('language_id');
            $table->foreign('language_id')->references('id')->on('language');
            $table->string('name', 255)->nullable();
            $table->string('description', 255)->nullable();
            $table->string('slug');
            $table->string('seo_title')->nullable();
            $table->text('seo_description')->nullable();
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
        Schema::dropIfExists('material_category_langs');
    }
}
