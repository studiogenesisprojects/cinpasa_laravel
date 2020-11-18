<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNoticiasEtiquetasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('noticia_etiquetas', function (Blueprint $table) {
            $table->increments('id');
            $table->boolean('activo')->default(1);
            $table->timestamps();
        });

        Schema::create('noticia_etiquetas_lang', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('noticia_etiqueta_id')->unsigned();
            $table->integer('idioma_id')->unsigned();
            $table->string('nombre', 255);
            $table->string('slug', 255);
            $table->timestamps();
            $table->index('noticia_etiqueta_id');
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
        Schema::dropIfExists('noticia_etiquetas');
        Schema::dropIfExists('noticia_etiquetas_lang');
    }
}
