<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearGalerysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('galerias', function (Blueprint $table) {
            $table->increments('id');
            $table->date('fecha');
            $table->string('titulo', 255);
            $table->boolean('activo')->default(1);
            $table->timestamps();
        });

        Schema::create('galeria_imagenes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('imagen', 255);
            $table->integer('galeria_id')->unsigned();
            $table->integer('orden')->unsigned()->default(0);
            $table->timestamps();
            $table->index('galeria_id');
        });

        Schema::create('galeria_imagenes_lang', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('galeria_imagen_id')->unsigned();
            $table->integer('idioma_id')->unsigned();
            $table->text('texto');
            $table->timestamps();
            $table->index('galeria_imagen_id');
            $table->index('idioma_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('galerias');
        Schema::dropIfExists('galeria_imagenes');
        Schema::dropIfExists('galeria_imagenes_lang');
    }
}