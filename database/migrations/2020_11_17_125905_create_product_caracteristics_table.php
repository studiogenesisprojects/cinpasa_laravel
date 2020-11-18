<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductCaracteristicsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_caracteristics', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id');
            $table->foreign('product_id')->references('id')->on('products');
            $table->string('rapport')->nullable();
            $table->float('width')->nullable();
            $table->integer('pockets')->nullable();
            $table->integer('laces')->nullable();
            $table->string('bags')->nullable();
            $table->string('packaging')->nullable();
            $table->float('length')->nullable();
            $table->string('flecortin_head')->nullable();
            $table->string('flecortin_width')->nullable();
            $table->boolean('presentation')->nullable();
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
        Schema::dropIfExists('product_caracteristics');
    }
}
