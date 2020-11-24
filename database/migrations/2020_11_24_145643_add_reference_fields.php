<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddReferenceFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products_references', function (Blueprint $table) {
            $table->bigInteger('bolsas')->nullable();
            $table->bigInteger('rapport')->nullable();
            $table->bigInteger('cordones')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products_references', function (Blueprint $table) {
            //
        });
    }
}
