<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobOffersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_offers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();

            $table->date('publication_date');
            $table->date('end_date');
        });

        Schema::create('job_offer_inscriptions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();

            $table->string('name');
            $table->string('email');
            $table->string('phone_number');
            $table->ipAddress('ip');
            $table->string('browser');

            $table->bigInteger('job_offer_id')->nullable()->unsigned();
            $table->foreign('job_offer_id')->references('id')->on('job_offers')->onDelete('cascade');
        });

        Schema::create('job_offer_resumes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();

            $table->string('name');
            $table->string('path');

            $table->bigInteger('job_offer_inscription_id')->nullable()->unsigned();
            $table->foreign('job_offer_inscription_id')->references('id')->on('job_offer_inscriptions')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('job_offers');
        Schema::dropIfExists('job_offer_inscriptions');
        Schema::dropIfExists('job_offer_resumes');
    }
}