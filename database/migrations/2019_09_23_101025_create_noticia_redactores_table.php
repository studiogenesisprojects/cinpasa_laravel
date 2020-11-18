<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNoticiaRedactoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('noticia_redactores', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre', 255);
            $table->string('email', 255)->nullable();
            $table->string('facebook', 255)->nullable();
            $table->string('twitter', 255)->nullable();
            $table->string('linkedin', 255)->nullable();
            $table->string('imagen', 255)->nullable();
            $table->string('slug', 255);
            $table->boolean('activo')->default(1);
            $table->timestamps();
        });

        Schema::create('noticia_redactores_lang', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('noticia_redactor_id')->unsigned();
            $table->integer('idioma_id')->unsigned();
            $table->text('biografia')->nullable();
            $table->timestamps();
            $table->index('noticia_redactor_id');
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
        Schema::dropIfExists('noticia_redactores');
        Schema::dropIfExists('noticia_redactores_lang');
    }
}
