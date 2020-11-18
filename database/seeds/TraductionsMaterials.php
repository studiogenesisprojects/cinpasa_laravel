<?php

use Illuminate\Database\Seeder;
use Spatie\TranslationLoader\LanguageLine;

class TraductionsMaterials extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $textos = [
            'es' => 'Más de 120 materiales diferentes',
            'ca' => 'Més de 120 materials diferents',
            'en' => 'More than 120 different materials',
            'fr' => 'Plus de 120 matériaux différents',
            'it' => 'Più di 120 materiali diversi',
        ];

        LanguageLine::create([
            'group' => 'Materiales',
            'key' => 'subtitulo',
            'text' => $textos
        ]);

        $textos = [
            'es' => 'Muestrario de productos según material',
            'ca' => 'Mostrari de productes segons material',
            'en' => 'Sample of products according to material',
            'fr' => 'Echantillon de produits en fonction du matériau',
            'it' => 'Campione di prodotti secondo il materiale',
        ];

        LanguageLine::create([
            'group' => 'Materiales',
            'key' => 'seccion1_titulo',
            'text' => $textos
        ]);

        $textos = [
            'es' => 'Selecciona el material y escoge...',
            'ca' => 'Selecciona el material i tria...',
            'en' => 'Select the material and choose...',
            'fr' => 'Sélectionnez le matériau et choisissez...',
            'it' => 'Selezionare il materiale e scegliere...',
        ];

        LanguageLine::create([
            'group' => 'Materiales',
            'key' => 'seccion1_texto',
            'text' => $textos
        ]);

        $textos = [
            'es' => 'Pídenos más información de estos materiales',
            'ca' => "Demana'ns més informació d'aquests materials",
            'en' => "Ask us for more information on these materials",
            'fr' => "Demandez-nous plus d'informations sur ces matériaux",
            'it' => 'Richiedi maggiori informazioni su questi materiali',
        ];

        LanguageLine::create([
            'group' => 'Materiales',
            'key' => 'titulo_formulario',
            'text' => $textos
        ]);

        $textos = [
            'es' => 'Cargando más materiales',
            'ca' => "Cargando más materiales",
            'en' => "Loading more materials",
            'fr' => "Charger plus de matériaux",
            'it' => 'Caricamento di altri materiali',
        ];

        LanguageLine::create([
            'group' => 'Materiales',
            'key' => 'cargando_materiales',
            'text' => $textos
        ]);
    }
}