<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateJobOfferLang extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('job_offers_lang', function(Blueprint $table){
            $table->string('name')->nullable()->change();
            $table->text('description')->nullable()->change();
            $table->text('additional_info')->nullable()->change();
            $table->string('time')->nullable()->change();
            $table->string('duration')->nullable()->change();
            $table->string('salary')->nullable()->change();
            $table->string('location')->nullable()->change();
            $table->text('requirements')->nullable()->change();

            $table->dropUnique(['slug']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
