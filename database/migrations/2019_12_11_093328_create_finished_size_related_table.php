<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFinishedSizeRelatedTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('finished_size_related', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();

            $table->unsignedBigInteger('finished_id')->unsigned();
            $table->foreign('finished_id')->references('id')->on('finisheds')->onDelete('cascade');

            $table->unsignedBigInteger('finished_size_id')->unsigned();
            $table->foreign('finished_size_id')->references('id')->on('finished_sizes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('finished_size_related');
    }
}
