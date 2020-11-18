<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobOffersLangTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_offers_lang', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('job_offer_id')->unsigned();
            $table->foreign('job_offer_id')->references('id')->on('job_offers')->onDelete('cascade');
            $table->integer('language_id')->unsigned();
            $table->foreign('language_id')->references('id')->on('language');
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description');
            $table->text('additional_info')->nullable();
            $table->string('time');
            $table->string('duration');
            $table->string('salary')->nullable();
            $table->string('location');
            $table->text('requirements');
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
        Schema::dropIfExists('job_offers_lang');
    }
}