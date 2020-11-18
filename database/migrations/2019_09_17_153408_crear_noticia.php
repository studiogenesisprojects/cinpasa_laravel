<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearNoticia extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('noticias', function (Blueprint $table) {
            $table->increments('id');
            $table->date('fecha_publicacion');
            $table->integer('redactor_id')->unsigned();
            $table->string('imagen_principal', 255)->default('');
            $table->boolean('activo')->default(1);
            $table->timestamps();
            $table->index('redactor_id');
        });

        Schema::create('noticias_lang', function (Blueprint $table) {
            $table->increments('id');
            $table->boolean('active')->default(1);
            $table->integer('noticia_id')->unsigned();
            $table->integer('idioma_id')->unsigned();
            $table->string('titulo', 255)->nullable();
            $table->string('subtitulo', 255)->nullable();
            $table->text('texto_corto')->nullable();
            $table->string('slug', 255)->nullable();
            $table->timestamps();
            $table->index('noticia_id');
            $table->index('idioma_id');
        });

        Schema::create('noticias_categorias_asociadas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('noticia_id')->unsigned();
            $table->integer('categoria_id')->unsigned();
            $table->timestamps();
            $table->index('noticia_id');
            $table->index('categoria_id');
        });

        Schema::create('noticias_etiquetas_asociadas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('noticia_id')->unsigned();
            $table->integer('etiqueta_id')->unsigned();
            $table->timestamps();
            $table->index('noticia_id');
            $table->index('etiqueta_id');
        });

        Schema::create('noticias_documentos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre_doc', 255);
            $table->string('identificador_doc', 255);
            $table->integer('noticia_id')->unsigned();
            $table->integer('idioma_id')->unsigned();
            $table->integer('orden')->unsigned()->default(0);
            $table->timestamps();
            $table->index('noticia_id');
            $table->index('idioma_id');
        });

        Schema::create('noticias_relacionadas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('noticia_id')->unsigned();
            $table->integer('idioma_id')->unsigned();
            $table->integer('noticia_relacionada')->unsigned();
            $table->integer('orden')->unsigned()->default(0);
            $table->timestamps();
            $table->index('noticia_id');
            $table->index('idioma_id');
        });

        Schema::create('noticias_bloques', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('noticia_id')->unsigned();
            $table->integer('idioma_id')->unsigned();
            $table->integer('bloque_id')->unsigned();
            $table->enum('tipo_bloque', [1, 2, 3, 4, 5, 6]);
            $table->integer('orden')->unsigned()->default(0);
            $table->timestamps();
            $table->index('noticia_id');
            $table->index('idioma_id');
            $table->index('bloque_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('noticias');
        Schema::dropIfExists('noticias_lang');
        Schema::dropIfExists('noticias_categorias_asociadas');
        Schema::dropIfExists('noticias_etiquetas_asociadas');
        Schema::dropIfExists('noticias_documentos');
        Schema::dropIfExists('noticias_relacionadas');
        Schema::dropIfExists('noticias_bloques');
    }
}
