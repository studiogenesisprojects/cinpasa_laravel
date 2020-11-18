<?php

use Illuminate\Database\Seeder;
use Spatie\TranslationLoader\LanguageLine;

class TraductionsApplications extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $textos = [
            'es' => 'Una solución para cada aplicación',
            'ca' => 'Una solució per a cada aplicació',
            'en' => 'A solution for every application',
            'fr' => 'Une solution pour chaque application',
            'it' => 'Una soluzione per ogni applicazione',
        ];

        LanguageLine::create([
            'group' => 'Aplicaciones',
            'key' => 'subtitulo',
            'text' => $textos
        ]);

        $textos = [
            'es' => 'Nuestras aplicaciones',
            'ca' => 'Les nostres aplicacions',
            'en' => 'Our applications',
            'fr' => 'Nos applications',
            'it' => 'Le nostre applicazioni',
        ];

        LanguageLine::create([
            'group' => 'Aplicaciones',
            'key' => 'seccion1_titulo',
            'text' => $textos
        ]);

        $textos = [
            'es' => 'En LIASA, La Industrial Algodonera estamos especializados en diferentes aplicaciones. Según la aplicación, buscamos una solución.',
            'ca' => "En LIASA, La Industrial Cotonera estem especialitzats en diferents aplicacions. Segons l'aplicació, busquem una solució.",
            'en' => 'In LIASA, La Industrial Algodonera we are specialized in different applications. Depending on the application, we look for a solution.',
            'fr' => "Chez LIASA, La Industrial Algodonera nous sommes spécialisés dans différentes applications. Selon l'application, nous cherchons une solution.",
            'it' => "In LIASA, La Industrial Algodonera siamo specializzati in diverse applicazioni. A seconda dell'applicazione, cerchiamo una soluzione.",
        ];

        LanguageLine::create([
            'group' => 'Aplicaciones',
            'key' => 'seccion1_texto',
            'text' => $textos
        ]);

        $textos = [
            'es' => '¿NECESITAS MÁS INFORMACIÓN?',
            'ca' => 'NECESSITES MÉS INFORMACIÓ?',
            'en' => 'NEED MORE INFORMATION?',
            'fr' => "BESOIN DE PLUS D'INFORMATIONS ?",
            'it' => 'HAI BISOGNO DI MAGGIORI INFORMAZIONI?',
        ];

        LanguageLine::create([
            'group' => 'Aplicaciones',
            'key' => 'seccion1_boton',
            'text' => $textos
        ]);

        $textos = [
            'es' => 'Pídenos más información de estas aplicaciones',
            'ca' => "Demana'ns més informació d'aquestes aplicacions",
            'en' => 'Ask us for more information on these applications',
            'fr' => "Demandez-nous plus d'informations sur ces applications",
            'it' => "Richiedi maggiori informazioni su queste applicazioni",
        ];

        LanguageLine::create([
            'group' => 'Aplicaciones',
            'key' => 'titulo_formulario',
            'text' => $textos
        ]);

        $textos = [
            'es' => 'Especializados en aplicaciones',
            'ca' => 'Especialitzats en aplicacions',
            'en' => 'Specialized in applications',
            'fr' => 'Spécialisé dans les applications',
            'it' => 'Specializzato in applicazioni',
        ];

        LanguageLine::create([
            'group' => 'Aplicaciones',
            'key' => 'aplicacion_padre_titulo',
            'text' => $textos
        ]);

        $textos = [
            'es' => ' Fabricamos cordones, cintas y cordones elásticos diseñados especialmente para el cliente. Podemos personalizar los productos en función de tus necesidades. ',
            'ca' => 'Fabriquem cordons, cintes i cordons elàstics dissenyats especialment per al client. Podem personalitzar els productes en funció de les teves necessitats.',
            'en' => 'We manufacture cords, tapes and elastic cords specially designed for the customer. We can customize the products according to your needs.',
            'fr' => 'Nous fabriquons des cordons, rubans et cordons élastiques spécialement conçus pour le client. Nous pouvons personnaliser les produits selon vos besoins. ',
            'it' => 'Produciamo cordoni, nastri e cordoni elastici progettati appositamente per il cliente. Possiamo personalizzare i prodotti in base alle vostre esigenze. ',
        ];

        LanguageLine::create([
            'group' => 'Aplicaciones',
            'key' => 'aplicacion_padre_subtitulo',
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
            'group' => 'Aplicaciones',
            'key' => 'aplicacion_padre_boton',
            'text' => $textos
        ]);
    }
}