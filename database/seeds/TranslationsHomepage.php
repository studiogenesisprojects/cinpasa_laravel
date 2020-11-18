<?php

use Illuminate\Database\Seeder;
use Spatie\TranslationLoader\LanguageLine;

class TranslationsHomepage extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $textos = [
            'es' => 'Productos y Aplicaciones',
            'ca' => 'Productes i Aplicacions',
            'en' => 'Products and Applications',
            'fr' => 'Produits et applications',
            'it' => 'Prodotti e Applicazioni',
        ];

        LanguageLine::create([
            'group' => 'Inicio',
            'key' => 'seccion1_titulo',
            'text' => $textos
        ]);

        $textos = [
            'es' => 'Ver Aplicaciones',
            'ca' => 'Veure Aplicacions',
            'en' => 'View Applications',
            'fr' => 'Voir les applications',
            'it' => 'Visualizza Applicazioni',
        ];

        LanguageLine::create([
            'group' => 'Inicio',
            'key' => 'seccion1_boton',
            'text' => $textos
        ]);

        $textos = [
            'es' => '¿Por qué LIASA La Industrial Algodonera?',
            'ca' => 'Per què LIASA La Industrial Cotonera?',
            'en' => 'Why LIASA The Industrial Cotton?',
            'fr' => 'Pourquoi LIASA Le Coton Industriel?',
            'it' => 'Perché LIASA il cotone industriale?',
        ];

        LanguageLine::create([
            'group' => 'Inicio',
            'key' => 'seccion2_titulo',
            'text' => $textos
        ]);

        $textos = [
            'es' => 'Desde el 1918, nuestro esfuerzo por evolucionar e innovar ha sido constante y somos un referente entre los principales fabricantes internacionales de cintas y cordones.',
            'ca' => 'Des del 1918, el nostre esforç per evolucionar i innovar ha estat constant i som un referent entre els principals fabricants internacionals de cintes i cordons.',
            'en' => 'Since 1918, our effort to evolve and innovate has been constant and we are a reference among the main international manufacturers of ribbons and cords.',
            'fr' => "Depuis 1918, notre effort d'évolution et d'innovation a été constant et nous sommes une référence parmi les principaux fabricants internationaux de rubans et cordons.",
            'it' => 'Dal 1918, il nostro sforzo di evoluzione e innovazione è stato costante e siamo un punto di riferimento tra i principali produttori internazionali di nastri e corde.',
        ];

        LanguageLine::create([
            'group' => 'Inicio',
            'key' => 'seccion2_texto1',
            'text' => $textos
        ]);

        $textos = [
            'es' => 'Nuestra consciencia ecológica y social forman parte de nuestro ADN.',
            'ca' => 'La nostra consciència ecològica i social formen part del nostre ADN.',
            'en' => 'Our ecological and social consciousness are part of our DNA.',
            'fr' => 'Notre conscience écologique et sociale fait partie de notre ADN.',
            'it' => 'La nostra coscienza ecologica e sociale fa parte del nostro DNA.',
        ];

        LanguageLine::create([
            'group' => 'Inicio',
            'key' => 'seccion2_texto2',
            'text' => $textos
        ]);

        $textos = [
            'es' => 'Fabricamos tantos metros como para dar dos vueltas al mundo cada año.',
            'ca' => 'Fabriquem tants metres com per a donar dues voltes al món cada any.',
            'en' => 'We build as many metres as we need to go around the world twice a year.',
            'fr' => "Nous construisons autant de mètres qu'il nous faut pour faire le tour du monde deux fois par an.",
            'it' => "Costruiamo tutti i metri di cui abbiamo bisogno per girare il mondo due volte all'anno.",
        ];

        LanguageLine::create([
            'group' => 'Inicio',
            'key' => 'seccion2_metros',
            'text' => $textos
        ]);

        $textos = [
            'es' => 'Hemos elaborado 800 colores diferentes en los últimos 100 años.',
            'ca' => 'Hem elaborat 800 colors diferents en els últims 100 anys.',
            'en' => 'We have produced 800 different colours in the last 100 years.',
            'fr' => "Nous avons produit 800 couleurs différentes au cours des 100 dernières années.",
            'it' => "Negli ultimi 100 anni abbiamo prodotto 800 colori diversi.",
        ];

        LanguageLine::create([
            'group' => 'Inicio',
            'key' => 'seccion2_color',
            'text' => $textos
        ]);

        $textos = [
            'es' => 'Ofrecemos un abanico de hasta 85 acabados diferentes. Seguimos trabajando para crear de nuevos.',
            'ca' => 'Oferim un ventall de fins a 85 acabats diferents. Continuem treballant per a crear de nous.',
            'en' => 'We offer a range of up to 85 different finishes. We keep working to create new ones.',
            'fr' => "Nous offrons une gamme allant jusqu'à 85 finitions différentes. Nous continuons à travailler pour en créer de nouveaux.",
            'it' => "Offriamo una gamma di 85 diverse finiture. Continuiamo a lavorare per crearne di nuovi.",
        ];

        LanguageLine::create([
            'group' => 'Inicio',
            'key' => 'seccion2_pantone',
            'text' => $textos
        ]);

        $textos = [
            'es' => 'Nuestros productos se exportan a 55 países y cinco continentes ¡nos falta la Antártida!',
            'ca' => "Els nostres productes s'exporten a 55 països i cinc continents ens falta l'Antàrtida!",
            'en' => 'Our products are exported to 55 countries and five continents. We lack Antarctica!',
            'fr' => "Nos produits sont exportés dans 55 pays et sur les cinq continents, sans l'Antarctique !",
            'it' => "I nostri prodotti sono esportati in 55 paesi e cinque continenti. Ci manca l'Antartide!",
        ];

        LanguageLine::create([
            'group' => 'Inicio',
            'key' => 'seccion2_exportar',
            'text' => $textos
        ]);

        $textos = [
            'es' => 'Conoce la empresa',
            'ca' => "Coneix l'empresa",
            'en' => 'Meet the company',
            'fr' => "Rencontrez l'entreprise",
            'it' => "Incontra l'azienda",
        ];

        LanguageLine::create([
            'group' => 'Inicio',
            'key' => 'seccion2_boton',
            'text' => $textos
        ]);

        $textos = [
            'es' => 'Actualidad',
            'ca' => "Actualitat",
            'en' => 'News',
            'fr' => "Actualit",
            'it' => "Notizie",
        ];

        LanguageLine::create([
            'group' => 'Inicio',
            'key' => 'seccion3_titulo',
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
            'group' => 'Inicio',
            'key' => 'seccion3_boton',
            'text' => $textos
        ]);

        $textos = [
            'es' => 'Ver todas las noticias',
            'ca' => "Veure totes les notícies",
            'en' => 'See all news',
            'fr' => "Voir toutes les actualités",
            'it' => "Vedi tutte le notizie",
        ];

        LanguageLine::create([
            'group' => 'Inicio',
            'key' => 'seccion3_boton2',
            'text' => $textos
        ]);

        $textos = [
            'es' => 'Trabaja con nosotros',
            'ca' => "Treballa amb nosaltres",
            'en' => 'Work with us',
            'fr' => "Travaillez avec nous",
            'it' => "Lavora con noi",
        ];

        LanguageLine::create([
            'group' => 'Inicio',
            'key' => 'seccion4_titulo',
            'text' => $textos
        ]);


        $textos = [
            'es' => '¿Quieres formar parte de nuestro equipo de profesionales? Nosotros también queremos conocerte, envíanos tu currículum.',
            'ca' => "Vols formar part del nostre equip de professionals? Nosaltres també volem conèixer-te, envia'ns el teu currículum.",
            'en' => 'Do you want to be part of our team of professionals? We also want to get to know you, send us your CV.',
            'fr' => "Vous souhaitez faire partie de notre équipe de professionnels ? Nous voulons aussi faire votre connaissance, envoyez-nous votre CV.",
            'it' => "Vuoi far parte del nostro team di professionisti? Vogliamo anche conoscerti, inviaci il tuo CV.",
        ];

        LanguageLine::create([
            'group' => 'Inicio',
            'key' => 'seccion4_texto1',
            'text' => $textos
        ]);

        $textos = [
            'es' => 'Envia tu CV',
            'ca' => "Envia el teu CV",
            'en' => 'Send your CV',
            'fr' => "Envoyez votre CV",
            'it' => "Invia il tuo CV",
        ];

        LanguageLine::create([
            'group' => 'Inicio',
            'key' => 'seccion4_boton',
            'text' => $textos
        ]);

        $textos = [
            'es' => 'Clientes',
            'ca' => "Clients",
            'en' => 'Customers',
            'fr' => "Clientèle",
            'it' => "I clienti",
        ];

        LanguageLine::create([
            'group' => 'Inicio',
            'key' => 'seccion5_titulo',
            'text' => $textos
        ]);
    }
}