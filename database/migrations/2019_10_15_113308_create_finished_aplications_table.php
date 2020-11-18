<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFinishedAplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('finished_aplications', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('aplication_id')->unsigned();
            $table->foreign('aplication_id')->references('id')->on('aplications');
            $table->bigInteger('finished_id')->unsigned();
            $table->foreign('finished_id')->references('id')->on('finisheds')->onDelete('cascade');
            $table->integer('order')->nullable();
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
        Schema::dropIfExists('finished_aplications');
    }
}