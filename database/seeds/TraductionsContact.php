<?php

use Illuminate\Database\Seeder;
use Spatie\TranslationLoader\LanguageLine;

class TraductionsContact extends Seeder
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
            'es' => '100 AÑOS TRENZANDO SOLUCIONES',
            'ca' => '100 ANYS TRENANT SOLUCIONS',
            'en' => '100 YEARS BRAIDING SOLUTIONS',
            'fr' => "100 ANS DE SOLUTIONS DE TRESSAGE",
            'it' => '100 ANNI DI SOLUZIONI DI TRECCIATURA',
        ];

        LanguageLine::create([
            'group' => 'Contacto',
            'key' => 'subtitulo',
            'text' => $textos
        ]);

        $textos = [
            'es' => 'Contacta con nosotros',
            'ca' => 'Contacta amb nosaltres',
            'en' => 'Contact with us',
            'fr' => 'Contact avec nous',
            'it' => 'Contatto con noi',
        ];

        LanguageLine::create([
            'group' => 'Contacto',
            'key' => 'seccion1_titulo',
            'text' => $textos
        ]);

        $textos = [
            'es' => 'No dude a ponerse en contacto con el equipo de Liasa, La Industrial Algodonera. Escriba a <a href="mailto:comercial@laindustrialalgodonera.com">comercial@laindustrialalgodonera.com</a> o telefonéenos al <a href="mailto:+34 977 844 000">+34 977 844 000</a>',
            'ca' => "No dubti a posar-se en contacte amb l'equip de Liasa, La Industrial Cotonera. Escrigui a comercial@laindustrialalgodonera.com <a href='mailto:comercial@laindustrialalgodonera.com'></a> o telefoni'ns al <a href='mailto:+34 977 844 000'>+34 977 844 000</a>",
            'en' => 'Do not hesitate to contact the team of Liasa, La Industrial Algodonera. Write to <a href="mailto:comercial@laindustrialalgodonera.com">comercial@laindustrialalgodonera.com</a> or call us at <a href="mailto:+34 977 844 000">+34 977 844 000</a>',
            'fr' => "N'hésitez pas à contacter l'équipe de Liasa, La Industrial Algodonera. Écrivez à <a href='mailto:comercial@laindustrialalgodonera.com'>comercial@laindustrialalgodonera.com</a> ou appelez-nous à <a href='mailto:+34 977 844 000'>+34 977 844 000</a>.",
            'it' => 'Non esitate a contattare il team di Liasa, La Industrial Algodonera. Scrivi a <a href="mailto:comercial@laindustrialalgodonera.com">comercial@laindustrialalgodonera.com</a> o chiamaci a <a href="mailto:+34 977 844 000">+34 977 844 000</a>.',
        ];

        LanguageLine::create([
            'group' => 'Contacto',
            'key' => 'seccion1_texto',
            'text' => $textos
        ]);

        $textos = [
            'es' => 'Nombre y apellidos',
            'ca' => 'Nom i apellits',
            'en' => 'Name and surname',
            'fr' => 'Nom et prénom',
            'it' => 'Nome e cognome',
        ];

        LanguageLine::create([
            'group' => 'Contacto',
            'key' => 'seccion1_input_nombre',
            'text' => $textos
        ]);

        $textos = [
            'es' => 'Empresa',
            'ca' => 'Empresa',
            'en' => 'Company',
            'fr' => 'Entreprise',
            'it' => 'Impresa',
        ];

        LanguageLine::create([
            'group' => 'Contacto',
            'key' => 'seccion1_input_empresa',
            'text' => $textos
        ]);

        $textos = [
            'es' => 'E-mail',
            'ca' => 'E-mail',
            'en' => 'E-mail',
            'fr' => 'E-mail',
            'it' => 'E-mail',
        ];

        LanguageLine::create([
            'group' => 'Contacto',
            'key' => 'seccion1_input_email',
            'text' => $textos
        ]);

        $textos = [
            'es' => 'Teléfono',
            'ca' => 'Telèfon',
            'en' => 'Phone number',
            'fr' => 'Téléphone',
            'it' => 'Telefono',
        ];

        LanguageLine::create([
            'group' => 'Contacto',
            'key' => 'seccion1_input_telefono',
            'text' => $textos
        ]);

        $textos = [
            'es' => 'País',
            'ca' => 'Païs',
            'en' => 'Country',
            'fr' => 'Pays',
            'it' => 'Paese',
        ];

        LanguageLine::create([
            'group' => 'Contacto',
            'key' => 'seccion1_select_pais',
            'text' => $textos
        ]);

        $textos = [
            'es' => 'Comentarios',
            'ca' => 'Comentaris',
            'en' => 'Comments',
            'fr' => 'Commentaires',
            'it' => 'Commenti',
        ];

        LanguageLine::create([
            'group' => 'Contacto',
            'key' => 'seccion1_input_comentarios',
            'text' => $textos
        ]);

        $textos = [
            'es' => 'He leído y acepto la',
            'ca' => 'He llegit i accepto la',
            'en' => 'I have read and accept the',
            'fr' => "J'ai lu et j'accepte le",
            'it' => 'Ho letto e accetto le',
        ];

        LanguageLine::create([
            'group' => 'Contacto',
            'key' => 'section1_checkbox_aceptar_politicas_part1',
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
            'group' => 'Contacto',
            'key' => 'section1_checkbox_aceptar_politicas_part2',
            'text' => $textos
        ]);

        $textos = [
            'es' => '<strong>Nota:</strong> Pedido inicial mínimo 400€',
            'ca' => '<strong>Nota:</strong> Primera comanda mínimo 400€',
            'en' => '<strong>Note:</strong> First orders minimum 400€',
            'fr' => '<strong>Note:</strong> Première commande minimum 400€',
            'it' => '<strong>Nota:</strong> Primo ordine minimo 400€',
        ];

        LanguageLine::create([
            'group' => 'Contacto',
            'key' => 'seccion1_pedido_minimo',
            'text' => $textos
        ]);

        $textos = [
            'es' => 'Enviar',
            'ca' => 'Enviar',
            'en' => 'Send',
            'fr' => 'Envoyer',
            'it' => 'Inviare',
        ];

        LanguageLine::create([
            'group' => 'Contacto',
            'key' => 'seccion1_formulario_boton',
            'text' => $textos
        ]);

        $textos = [
            'es' => 'Ven a nuestras oficinas',
            'ca' => 'Veuen a les nostres oficines',
            'en' => 'Come to our offices',
            'fr' => 'Venez à nos bureaux',
            'it' => 'Vieni nei nostri uffici',
        ];

        LanguageLine::create([
            'group' => 'Contacto',
            'key' => 'seccion2_titulo',
            'text' => $textos
        ]);

        $textos = [
            'es' => 'Localización',
            'ca' => 'Localització',
            'en' => 'Location',
            'fr' => 'Lieu',
            'it' => 'Posizione',
        ];

        LanguageLine::create([
            'group' => 'Contacto',
            'key' => 'seccion3_titulo',
            'text' => $textos
        ]);

        $textos = [
            'es' => 'LIASA OFICINAS',
            'ca' => 'LIASA OFICINES',
            'en' => 'LIASA OFFICES',
            'fr' => 'BUREAUX DE LIASA',
            'it' => 'UFFICI LIASA',
        ];

        LanguageLine::create([
            'group' => 'Contacto',
            'key' => 'seccion3_oficinas',
            'text' => $textos
        ]);

        $textos = [
            'es' => 'CARGA / DESCARGA DE CAMIONES ',
            'ca' => 'CARREGA / DESCÀRREGA DE CAMIONS',
            'en' => 'TRUCK LOADING/UNLOADING ',
            'fr' => 'CHARGEMENT/DÉCHARGEMENT DE CAMIONS ',
            'it' => 'CARICO/SCARICO CAMION ',
        ];

        LanguageLine::create([
            'group' => 'Contacto',
            'key' => 'seccion3_carga_de_camiones',
            'text' => $textos
        ]);

        // TODO: posar el link al seu lloc
        $textos = [
            'es' => '<a href="https://www.google.com/maps/place/Raval+de+Sant+Rafael,+21,+43470+La+Selva+del+Camp,+Tarragona/@41.2137305,1.1340691,17z/data=!3m1!4b1!4m5!3m4!1s0x12a1540a95fa7bf9:0xf39682c8be9138ab!8m2!3d41.2137305!4d1.1362578" target="_blank" class="text-primary text-sm mt-5 d-block"><u>Ver localización en el mapa</u></a>',
            'ca' => '<a href="https://www.google.com/maps/place/Raval+de+Sant+Rafael,+21,+43470+La+Selva+del+Camp,+Tarragona/@41.2137305,1.1340691,17z/data=!3m1!4b1!4m5!3m4!1s0x12a1540a95fa7bf9:0xf39682c8be9138ab!8m2!3d41.2137305!4d1.1362578" target="_blank" class="text-primary text-sm mt-5 d-block"><u>Veure localització en el mapa</u></a>',
            'en' => '<a href="https://www.google.com/maps/place/Raval+de+Sant+Rafael,+21,+43470+La+Selva+del+Camp,+Tarragona/@41.2137305,1.1340691,17z/data=!3m1!4b1!4m5!3m4!1s0x12a1540a95fa7bf9:0xf39682c8be9138ab!8m2!3d41.2137305!4d1.1362578" target="_blank" class="text-primary text-sm mt-5 d-block"><u>View location on map</u></a>',
            'fr' => "<a href='https://www.google.com/maps/place/Raval+de+Sant+Rafael,+21,+43470+La+Selva+del+Camp,+Tarragona/@41.2137305,1.1340691,17z/data=!3m1!4b1!4m5!3m4!1s0x12a1540a95fa7bf9:0xf39682c8be9138ab!8m2!3d41.2137305!4d1.1362578' target='_blank' class='text-primary text-sm mt-5 d-block'><u>Voir l'emplacement sur la carte</u></a>a",
            'it' => '<a href="https://www.google.com/maps/place/Raval+de+Sant+Rafael,+21,+43470+La+Selva+del+Camp,+Tarragona/@41.2137305,1.1340691,17z/data=!3m1!4b1!4m5!3m4!1s0x12a1540a95fa7bf9:0xf39682c8be9138ab!8m2!3d41.2137305!4d1.1362578" target="_blank" class="text-primary text-sm mt-5 d-block"><u>Visualizza la posizione sulla mappa</u></a>',
        ];

        LanguageLine::create([
            'group' => 'Contacto',
            'key' => 'seccion3_link_al_mapa',
            'text' => $textos
        ]);

        $textos = [
            'es' => 'Teléfono',
            'ca' => 'Telèfon',
            'en' => 'Phone',
            'fr' => 'Téléphone',
            'it' => 'Telefono',
        ];

        LanguageLine::create([
            'group' => 'Contacto',
            'key' => 'seccion4_titulo',
            'text' => $textos
        ]);

        $textos = [
            'es' => ' At. Cliente:',
            'ca' => 'Atenció al client:',
            'en' => 'Customer service:',
            'fr' => 'Service à la clientèle :',
            'it' => 'Servizio clienti:',
        ];

        LanguageLine::create([
            'group' => 'Contacto',
            'key' => 'seccion4_atencion_al_cliente',
            'text' => $textos
        ]);

        $textos = [
            'es' => 'Compras:',
            'ca' => 'Compres:',
            'en' => 'Shopping:',
            'fr' => 'Shopping :',
            'it' => 'Shopping:',
        ];

        LanguageLine::create([
            'group' => 'Contacto',
            'key' => 'seccion4_compras',
            'text' => $textos
        ]);

        $textos = [
            'es' => 'Administración y RRHH:',
            'ca' => 'Administració i RRHH',
            'en' => 'Administration and human resources',
            'fr' => 'Administration et ressources humaines :',
            'it' => 'Amministrazione e Risorse Umane:',
        ];

        LanguageLine::create([
            'group' => 'Contacto',
            'key' => 'seccion4_administracion',
            'text' => $textos
        ]);

        $textos = [
            'es' => 'E-mail',
            'ca' => 'E-mail',
            'en' => 'E-mail',
            'fr' => 'E-mail',
            'it' => 'E-mail',
        ];

        LanguageLine::create([
            'group' => 'Contacto',
            'key' => 'section5_titulo',
            'text' => $textos
        ]);

        $textos = [
            'es' => 'Contáctanos en:',
            'ca' => "Contacta'ns en:",
            'en' => 'Contact us at:',
            'fr' => 'Contactez-nous à :',
            'it' => 'Contattaci a:',
        ];

        LanguageLine::create([
            'group' => 'Contacto',
            'key' => 'section5_subtitulo',
            'text' => $textos
        ]);
    }
}