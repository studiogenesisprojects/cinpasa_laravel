<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFinishedsLangsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('finisheds_langs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('finished_id')->unsigned();
            $table->foreign('finished_id')->references('id')->on('finisheds')->onDelete('cascade');
            $table->integer('language_id')->unsigned();
            $table->foreign('language_id')->references('id')->on('language');
            $table->string('name');
            $table->string('subtitle')->nullable();
            $table->string('slug');
            $table->string('lite_description', 160)->nullable();
            $table->text('large_description')->nullable();
            $table->text('observations')->nullable();
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
        Schema::dropIfExists('finisheds_langs');
    }
}
