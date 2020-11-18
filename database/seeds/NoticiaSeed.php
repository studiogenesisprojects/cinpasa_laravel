<?php

use App\Models\Language;
use App\Models\Noticia;
use App\Models\NoticiaCategoria;
use App\Models\NoticiaCategoriaAsociada;
use App\Models\NoticiaCategoriaLang;
use App\Models\NoticiaEtiqueta;
use App\Models\NoticiaEtiquetaAsociada;
use App\Models\NoticiaEtiquetaLang;
use App\Models\NoticiaLang;
use App\Models\NoticiaRedactor;
use App\Models\NoticiaRedactorLang;
use Illuminate\Database\Seeder;

class NoticiaSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        foreach (range(0, 5) as $index) {
            //redactores
            $redactor = NoticiaRedactor::create([
                "nombre" => $faker->name,
                "email" => $faker->email,
                "facebook" => $faker->text,
                "twitter" => $faker->text,
                "linkedin" => $faker->text,
                "imagen" => $faker->text,
                "slug" => $faker->slug,
                "activo" => 1
            ]);

            foreach (Language::all() as $key => $idioma) {
                NoticiaRedactorLang::create([
                    "noticia_redactor_id" => $redactor->id,
                    "idioma_id" => $idioma->id,
                    "biografia" => $faker->text
                ]);
            }

            $cateogory = NoticiaCategoria::create([
                "activo" => 1
            ]);

            foreach (Language::all() as $key => $idioma) {
                NoticiaCategoriaLang::create([
                    "noticia_categoria_id" => $cateogory->id,
                    "idioma_id" => $idioma->id,
                    "nombre" => $faker->firstName,
                    "slug" => $faker->slug,
                ]);
            }


            $label = NoticiaEtiqueta::create([
                "activo" => 1
            ]);

            foreach (Language::all() as $key => $idioma) {
                NoticiaEtiquetaLang::create([
                    "noticia_etiqueta_id" => $label->id,
                    "idioma_id" => $idioma->id,
                    "nombre" => $faker->name,
                    "slug" => $faker->slug,
                ]);
            }

            $noticia = Noticia::create([
                'fecha_publicacion' => $faker->date,
                'redactor_id' => $redactor->id,
                'imagen_principal' => 'noticia.jpg',
                'activo' => 1
            ]);

            foreach (Language::all() as $key => $idioma) {
                NoticiaLang::create([
                    "noticia_id" => $noticia->id,
                    "idioma_id" => $idioma->id,
                    "titulo" => $faker->name,
                    "subtitulo" => $faker->name,
                    "texto_corto" => $faker->text,
                    "slug" => $faker->slug,
                ]);
            }
            NoticiaCategoriaAsociada::create([
                "noticia_id" => $noticia->id,
                "categoria_id" => $cateogory->id
            ]);

            NoticiaEtiquetaAsociada::create([
                "noticia_id" => $noticia->id,
                "etiqueta_id" => $label->id
            ]);
        }
    }
}