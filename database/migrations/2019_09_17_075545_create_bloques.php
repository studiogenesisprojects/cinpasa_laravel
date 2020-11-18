<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBloques extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bloque_textos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('clase', 255)->nullable()->default(null);
            $table->text('texto')->nullable()->default(null);
            $table->boolean('activo')->default(1);
            $table->timestamps();
        });

        Schema::create('bloque_imagenes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('clase', 255)->nullable()->default(null);
            $table->string('imagen', 255)->default('');
            $table->string('pie_foto', 255)->nullable()->default(null);
            $table->text('alt')->nullable()->default(null);
            $table->boolean('activo')->default(1);
            $table->timestamps();
        });

        Schema::create('bloque_videos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('clase', 255)->nullable()->default(null);
            $table->text('codigo')->nullable()->default(null);
            $table->string('pie_video', 255)->nullable()->default(null);
            $table->boolean('activo')->default(1);
            $table->timestamps();
        });

        Schema::create('bloque_galerias', function (Blueprint $table) {
            $table->increments('id');
            $table->string('clase', 255)->nullable()->default(null);
            $table->integer('galeria_id')->unsigned();
            $table->string('pie_galeria', 255)->nullable()->default(null);
            $table->boolean('activo')->default(1);
            $table->timestamps();
            $table->index('galeria_id');
        });

        Schema::create('bloque_mapas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('clase', 255)->nullable()->default(null);
            $table->string('direccion', 255)->nullable()->default(null);
            $table->double('latitud');
            $table->double('longitud');
            $table->string('imagen_puntero', 255)->default('');
            $table->text('texto_puntero')->nullable()->default(null);
            $table->string('pie_mapa', 255)->nullable()->default(null);
            $table->boolean('activo')->default(1);
            $table->timestamps();
        });

        Schema::create('bloque_separadores', function (Blueprint $table) {
            $table->increments('id');
            $table->string('clase', 255)->nullable()->default(null);
            $table->boolean('activo')->default(1);
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
        Schema::dropIfExists('bloque_textos');
        Schema::dropIfExists('bloque_imagenes');
        Schema::dropIfExists('bloque_videos');
        Schema::dropIfExists('bloque_galerias');
        Schema::dropIfExists('bloque_mapas');
        Schema::dropIfExists('bloque_separadores');
    }
}