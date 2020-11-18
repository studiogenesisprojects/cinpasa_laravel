<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFinishedsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('finisheds', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('list_image', 255)->nullable();
            $table->string('section_image', 255)->nullable();
            $table->bigInteger('galery_id')->unsigned()->nullable();
            $table->foreign('galery_id')->references('id')->on('finisheds_galery');
            $table->boolean('active')->nullable()->default(1);
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
        Schema::dropIfExists('finisheds');
    }
}
