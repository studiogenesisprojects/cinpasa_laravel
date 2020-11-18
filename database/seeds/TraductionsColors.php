<?php

use Illuminate\Database\Seeder;
use Spatie\TranslationLoader\LanguageLine;

class TraductionsColors extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $textos = [
            'es' => 'Más de 120 colores diferentes',
            'ca' => 'Més de 120 colors diferents',
            'en' => 'More than 120 different colors',
            'fr' => 'Plus de 120 couleurs différentes',
            'it' => 'Più di 120 colori diversi',
        ];

        LanguageLine::create([
            'group' => 'Colores',
            'key' => 'subtitulo',
            'text' => $textos
        ]);

        $textos = [
            'es' => 'Muestrario de productos según color',
            'ca' => 'Mostrari de productes segons color',
            'en' => 'Product sampler by colour',
            'fr' => 'Échantillonneur de produit par couleur',
            'it' => 'Campionatore di prodotto per colore',
        ];

        LanguageLine::create([
            'group' => 'Colores',
            'key' => 'seccion1_titulo',
            'text' => $textos
        ]);

        $textos = [
            'es' => 'Selecciona el color y escoge...',
            'ca' => 'Selecciona el color i tria...',
            'en' => 'Select the color and choose...',
            'fr' => 'Sélectionnez la couleur et choisissez...',
            'it' => 'Selezionare il colore e scegliere...',
        ];

        LanguageLine::create([
            'group' => 'Colores',
            'key' => 'seccion1_texto',
            'text' => $textos
        ]);

        $textos = [
            'es' => 'Pídenos más información de estos colores',
            'ca' => "Demana'ns més informació d'aquests colors",
            'en' => 'Ask us for more information about these colors',
            'fr' => "Demandez-nous plus d'informations sur ces couleurs",
            'it' => 'Richiedi maggiori informazioni su questi colori',
        ];

        LanguageLine::create([
            'group' => 'Colores',
            'key' => 'titulo_formulario',
            'text' => $textos
        ]);
    }
}