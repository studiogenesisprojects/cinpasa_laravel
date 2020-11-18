<?php

use Illuminate\Database\Seeder;
use Spatie\TranslationLoader\LanguageLine;

class TranslationsHeader extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $textos = [
            'es' => 'Empresa',
            'ca' => 'Empresa',
            'en' => 'Company',
            'fr' => 'Entreprise',
            'it' => 'Impresa',
        ];

        LanguageLine::create([
            'group' => 'Encabezado',
            'key' => 'empresa',
            'text' => $textos
        ]);

        $textos = [
            'es' => 'Productos',
            'ca' => 'Productes',
            'en' => 'Product',
            'fr' => 'Produit',
            'it' => 'Prodotti',
        ];

        LanguageLine::create([
            'group' => 'Encabezado',
            'key' => 'productos',
            'text' => $textos
        ]);

        $textos = [
            'es' => 'Acabados',
            'ca' => 'Acabats',
            'en' => 'Endings',
            'fr' => 'Finitions',
            'it' => 'Terminali',
        ];

        LanguageLine::create([
            'group' => 'Encabezado',
            'key' => 'acabados',
            'text' => $textos
        ]);

        $textos = [
            'es' => 'Aplicaciones',
            'ca' => 'Aplicacions',
            'en' => 'Applications',
            'fr' => 'Candidatures',
            'it' => 'Applicazioni',
        ];

        LanguageLine::create([
            'group' => 'Encabezado',
            'key' => 'aplicaciones',
            'text' => $textos
        ]);

        $textos = [
            'es' => 'Materiales',
            'ca' => 'Materials',
            'en' => 'Materials',
            'fr' => 'Materiels',
            'it' => 'Materiali',
        ];

        LanguageLine::create([
            'group' => 'Encabezado',
            'key' => 'materiales',
            'text' => $textos
        ]);

        $textos = [
            'es' => 'Colores',
            'ca' => 'Colors',
            'en' => 'Colors',
            'fr' => 'Couleurs',
            'it' => 'Colori',
        ];

        LanguageLine::create([
            'group' => 'Encabezado',
            'key' => 'colores',
            'text' => $textos
        ]);

        $textos = [
            'es' => 'Actualidad',
            'ca' => 'Actualitat',
            'en' => 'News',
            'fr' => 'Actualités',
            'it' => 'Notizie',
        ];

        LanguageLine::create([
            'group' => 'Encabezado',
            'key' => 'noticias',
            'text' => $textos
        ]);

        $textos = [
            'es' => 'Contacta',
            'ca' => 'Contacta',
            'en' => 'Contact',
            'fr' => 'Contact',
            'it' => 'Contatto',
        ];

        LanguageLine::create([
            'group' => 'Encabezado',
            'key' => 'contacta',
            'text' => $textos
        ]);
    }
}