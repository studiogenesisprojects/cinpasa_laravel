<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFinishedMaterialsLangsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('finished_materials_langs', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->timestamps();
            $table->string("name");

            $table->unsignedBigInteger('finished_material_id')->unsigned();
            $table->foreign('finished_material_id')->references('id')->on('finisheds_materials')->onDelete('cascade');

            $table->integer('language_id')->unsigned();
            $table->foreign('language_id')->references('id')->on('language')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('finished_materials_langs');
    }
}