<?php


use Illuminate\Database\Seeder;
use Spatie\TranslationLoader\LanguageLine;

class TranslationsCoockieConsent extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $faker = Faker\Factory::create();
        $textos = [
            'es' => 'Este sitio web usa cookies para mejorar la experiencia en nuestra página web. ',
            'ca' => "Aquest lloc web usa cookies per a millorar l'experiència en la nostra pàgina web.",
            'en' => 'This website uses cookies to ensure you get the best experience on our website. ',
            'fr' => "Ce site Web utilise des cookies pour améliorer l'expérience sur notre site Web.",
            'it' => "Questo sito web utilizza i cookie per migliorare l'esperienza sul nostro sito web.",
        ];

        LanguageLine::create([
            'group' => 'Cookies',
            'key' => 'texto',
            'text' => $textos
        ]);

        $textos = [
            'es' => 'Saber más',
            'ca' => 'Saber més',
            'en' => 'Learn more',
            'fr' => 'Pour en savoir plus',
            'it' => 'Per saperne di più'
        ];

        LanguageLine::create([
            'group' => 'Cookies',
            'key' => 'info_link',
            'text' => $textos
        ]);

        $textos = [
            'es' => 'Rechazar',
            'ca' => "Rebutjar",
            'en' => 'Decline',
            'fr' => 'Rejeter',
            'it' => 'Rifiuta'
        ];

        LanguageLine::create([
            'group' => 'Cookies',
            'key' => 'rechazar',
            'text' => $textos
        ]);

        $textos = [
            'es' => 'Aceptar cookies',
            'ca' => 'Acceptar cookies',
            'en' => 'Allow cookies',
            'fr' => 'Accepter les cookies',
            'it' => 'Accettare i cookie'
        ];

        LanguageLine::create([
            'group' => 'Cookies',
            'key' => 'aceptar',
            'text' => $textos
        ]);
    }
}