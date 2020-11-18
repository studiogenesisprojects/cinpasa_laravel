<?php

use Illuminate\Database\Seeder;
use Spatie\TranslationLoader\LanguageLine;

class TraductionsFooter extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $textos = [
            'es' => 'Aviso legal',
            'ca' => 'Avís legal',
            'en' => 'Legal Notice',
            'fr' => 'Mentions légales',
            'it' => 'Avviso legale',
        ];

        LanguageLine::create([
            'group' => 'Footer',
            'key' => 'enlace_aviso_legal',
            'text' => $textos
        ]);

        $textos = [
            'es' => 'Política de privacidad',
            'ca' => 'Política de privacitat',
            'en' => 'Privacy Policy',
            'fr' => 'Politique de confidentialité',
            'it' => 'Informativa sulla privacy'
        ];

        LanguageLine::create([
            'group' => 'Footer',
            'key' => 'enlace_politica_privacidad',
            'text' => $textos
        ]);

        $textos = [
            'es' => 'Política de cookies',
            'ca' => 'Política de cookies',
            'en' => 'Cookies Policy',
            'fr' => 'Politique sur les cookies',
            'it' => 'Politica sui cookie'
        ];

        LanguageLine::create([
            'group' => 'Footer',
            'key' => 'enlace_politica_cookies',
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
            'group' => 'Footer',
            'key' => 'trabaja_con_nosotros',
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
            'group' => 'Footer',
            'key' => 'contacta',
            'text' => $textos
        ]);

        $textos = [
            'es' => 'Otros productos',
            'ca' => 'Altres productes',
            'en' => 'Other products',
            'fr' => 'Autres produits',
            'it' => 'Altri prodotti',
        ];

        LanguageLine::create([
            'group' => 'Footer',
            'key' => 'mas_productos',
            'text' => $textos
        ]);

        $textos = [
            'es' => 'Más aplicaciones',
            'ca' => 'Més aplicacions',
            'en' => 'More applications',
            'fr' => "Plus d'applications",
            'it' => 'Altre applicazioni',
        ];

        LanguageLine::create([
            'group' => 'Footer',
            'key' => 'mas_aplicaciones',
            'text' => $textos
        ]);
    }
}