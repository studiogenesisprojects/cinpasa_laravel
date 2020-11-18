<?php

use Illuminate\Database\Seeder;
use Spatie\TranslationLoader\LanguageLine;

class TraductionsNews extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $textos = [
            'es' => 'Últimas novedades',
            'ca' => 'Últimes novetats',
            'en' => 'Latest news',
            'fr' => 'Dernières nouvelles',
            'it' => 'Ultime notizie',
        ];

        LanguageLine::create([
            'group' => 'Noticias',
            'key' => 'seccion1_titulo',
            'text' => $textos
        ]);

        $textos = [
            'es' => 'Aquí puedes encontrar las últimas novedades y noticias publicadas a LIASA. ',
            'ca' => 'Aquí pots trobar les últimes novetats i notícies publicades a LIASA.',
            'en' => 'Here you can find the latest news published to LIASA. ',
            'fr' => 'Vous trouverez ici les dernières nouvelles publiées par LIASA. ',
            'it' => 'Qui potete trovare le ultime notizie pubblicate su LIASA. ',
        ];

        LanguageLine::create([
            'group' => 'Noticias',
            'key' => 'seccion1_texto',
            'text' => $textos
        ]);

        $textos = [
            'es' => 'Ver noticia',
            'ca' => "Veure notícia",
            'en' => 'See news',
            'fr' => "Voir les actualités",
            'it' => "Guarda le notizie",
        ];

        LanguageLine::create([
            'group' => 'Noticias',
            'key' => 'noticias_boton',
            'text' => $textos
        ]);

        $textos = [
            'es' => 'Cargando más noticias',
            'ca' => 'Carregant més notícies',
            'en' => 'Loading more news',
            'fr' => "Chargement d'autres nouvelles",
            'it' => 'Caricamento di altre notizie',
        ];

        LanguageLine::create([
            'group' => 'Noticias',
            'key' => 'cargando_noticias',
            'text' => $textos
        ]);
    }
}