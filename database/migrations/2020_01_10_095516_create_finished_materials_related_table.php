<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFinishedMaterialsRelatedTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('finished_materials_related', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();

            $table->unsignedBigInteger('finished_id')->unsigned();
            $table->foreign('finished_id')->references('id')->on('finisheds')->onDelete('cascade');

            $table->unsignedBigInteger('finished_material_id')->unsigned();
            $table->foreign('finished_material_id')->references('id')->on('finisheds_materials')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('finished_materials_related');
    }
}