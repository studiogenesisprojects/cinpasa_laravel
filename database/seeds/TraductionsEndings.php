<?php

use Illuminate\Database\Seeder;
use Spatie\TranslationLoader\LanguageLine;

class TraductionsEndings extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $textos = [
            'es' => 'Más de 20 acabados por escoger',
            'ca' => 'Més de 20 acabats per triar',
            'en' => 'More than 20 finishes to choose from',
            'fr' => 'Plus de 20 finitions au choix',
            'it' => 'Più di 20 finiture tra cui scegliere',
        ];

        LanguageLine::create([
            'group' => 'Acabados',
            'key' => 'subtitulo',
            'text' => $textos
        ]);

        $textos = [
            'es' => 'Dando un toque especial a cada producto',
            'ca' => 'Donant un toc especial a cada producte',
            'en' => 'Giving a special touch to each product',
            'fr' => 'Donner une touche spéciale à chaque produit',
            'it' => 'Dare un tocco speciale ad ogni prodotto',
        ];

        LanguageLine::create([
            'group' => 'Acabados',
            'key' => 'seccion1_titulo',
            'text' => $textos
        ]);

        $textos = [
            'es' => ' Definimos acabado como un valor añadido que le damos al cordón, ya sea incluyendo una pieza en sus extremidades, ya sea realizando alguna manipulación extra, ya sea mejorando su presentación. Nuestros acabados son fabricados automáticamente por automatismos ingeniados por nosotros mismos aplicando el know-how de todos estos años de conocimiento de nuestros productos.',
            'ca' => 'Definim acabat com un valor afegit que li donem al cordó, ja sigui incloent una peça en les seves extremitats, ja sigui realitzant alguna manipulació extra, ja sigui millorant la seva presentació. Els nostres acabats són fabricats automàticament per automatismes enginyats per nosaltres mateixos aplicant el know-how de tots aquests anys de coneixement dels nostres productes.',
            'en' => 'We define finishing as an added value that we give to the cord, either by including a piece in its extremities, or by carrying out some extra manipulation, or by improving its presentation. Our finishes are automatically manufactured by automatisms engineered by ourselves applying the know-how of all these years of knowledge of our products.',
            'fr' => 'Nous définissons la finition comme une valeur ajoutée que nous donnons à la corde, soit en incluant une pièce dans ses extrémités, soit en effectuant une manipulation supplémentaire, soit en améliorant sa présentation. Nos finitions sont fabriquées automatiquement par des automatismes conçus par nos soins en appliquant le savoir-faire de toutes ces années de connaissance de nos produits.',
            'it' => 'Definiamo la finitura come un valore aggiunto che diamo alla corda, sia inserendo un pezzo nelle sue estremità, o effettuando qualche manipolazione in più, o migliorando la sua presentazione. Le nostre finiture sono prodotte automaticamente da automatismi progettati da noi stessi applicando il know-how di tutti questi anni di conoscenza dei nostri prodotti.',
        ];

        LanguageLine::create([
            'group' => 'Acabados',
            'key' => 'seccion1_texto',
            'text' => $textos
        ]);

        $textos = [
            'es' => 'Filtrar acabados por aplicación',
            'ca' => 'Filtrar acabats per aplicació',
            'en' => 'Filter finishes by application',
            'fr' => 'Filtrer les finitions par application',
            'it' => 'Finiture dei filtri per applicazione',
        ];

        LanguageLine::create([
            'group' => 'Acabados',
            'key' => 'filtro_placeholder',
            'text' => $textos
        ]);

        $textos = [
            'es' => 'Pídenos más información de estos acabados',
            'ca' => "Demana'ns més informació d'aquests acabats",
            'en' => 'Ask us for more information about these finishes',
            'fr' => "Demandez-nous plus d'informations sur ces finitions",
            'it' => 'Richiedeteci maggiori informazioni su queste finiture',

        ];
        LanguageLine::create([
            'group' => 'Acabados',
            'key' => 'titulo_formulario',
            'text' => $textos
        ]);

        $textos = [
            'es' => 'Cargando más acabados',
            'ca' => 'Carregant més acabats',
            'en' => 'Loading more finishes',
            'fr' => "Chargement d'un plus grand nombre de finitions",
            'it' => 'Caricamento di più finiture',

        ];
        LanguageLine::create([
            'group' => 'Acabados',
            'key' => 'cargando_acabados',
            'text' => $textos
        ]);

        $textos = [
            'es' => 'Ver acabado',
            'ca' => 'Veure acabat',
            'en' => 'See finish',
            'fr' => 'Voir la finition',
            'it' => 'Vedi finitura',

        ];
        LanguageLine::create([
            'group' => 'Acabados',
            'key' => 'boton_acabado',
            'text' => $textos
        ]);
    }
}