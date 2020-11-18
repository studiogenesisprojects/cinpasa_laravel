<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeigKeyCarouselIdToSectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('sections')) {
            Schema::table('sections', function (Blueprint $table) {
                $table->bigInteger('carousel_id')->nullable()->unsigned();
                $table->foreign('carousel_id')->references('id')->on('carousel');
            });
        }
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasTable('sections')) {
            Schema::table('sections', function (Blueprint $table) {
                $table->bigInteger('carousel_id')->nullable()->unsigned();
                $table->foreign('carousel_id')->references('id')->on('carousel');
            });
        }
    }
}