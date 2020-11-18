<?php

use Illuminate\Database\Seeder;
use Spatie\TranslationLoader\LanguageLine;

class TraductionsJobsOffers extends Seeder
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
            'es' => '¿Quieres formar parte de nuestro equipo?',
            'ca' => 'Vols formar part del nostre equip?',
            'en' => 'You want to form part of our squad?',
            'fr' => 'Veux faire partie de notre équipe?',
            'it' => 'Vuoi far parte della nostra squadra?',
        ];

        LanguageLine::create([
            'group' => 'TrabajaConNosotros',
            'key' => 'titulo',
            'text' => $textos
        ]);

        $textos = [
            'es' => 'Ofertas de trabajo',
            'ca' => 'Ofertes de treball',
            'en' => 'Job offers',
            'fr' => "Offres d'emploi",
            'it' => 'Ofertas de trabajo',
        ];

        LanguageLine::create([
            'group' => 'TrabajaConNosotros',
            'key' => 'navegacion_oferta_titulo',
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
            'group' => 'TrabajaConNosotros',
            'key' => 'navegacion_trabaja_con_nosotros_titulo',
            'text' => $textos
        ]);

        $textos = [
            'es' => '100 años innovando para tí',
            'ca' => '100 anys innovant per a tí',
            'en' => '100 years of innovation for you',
            'fr' => "100 ans d'innovation pour vous",
            'it' => "100 anni di innovazione per voi",
        ];

        LanguageLine::create([
            'group' => 'TrabajaConNosotros',
            'key' => 'subtitulo',
            'text' => $textos
        ]);

        $textos = [
            'es' => '¿Porqué Liasa?',
            'ca' => 'Perquè Liasa?',
            'en' => 'Why Liasa?',
            'fr' => 'Pourquoi Liasa ?',
            'it' => 'Perché Liasa?',
        ];

        LanguageLine::create([
            'group' => 'TrabajaConNosotros',
            'key' => 'seccion1_titulo',
            'text' => $textos
        ]);

        $textos = [
            'es' => $faker->text,
            'ca' => $faker->text,
            'en' => $faker->text,
            'fr' => $faker->text,
            'it' => $faker->text,
        ];

        LanguageLine::create([
            'group' => 'TrabajaConNosotros',
            'key' => 'seccion1_texto',
            'text' => $textos
        ]);

        $textos = [
            'es' => 'Eléctromecánico',
            'ca' => 'Electromecànic',
            'en' => 'Electromechanical ',
            'fr' => 'Électromécanique ',
            'it' => 'Elettromeccanico ',
        ];

        LanguageLine::create([
            'group' => 'TrabajaConNosotros',
            'key' => 'seccion1_fila1_titulo1',
            'text' => $textos
        ]);

        $textos = [
            'es' => 'Tienes experiencia en preventivo y correctivo en planta industrial? Te estamos esperando!',
            'ca' => "Tens experiència en preventiu i correctiu en planta industrial? T'estem esperant!",
            'en' => 'Do you have experience in preventive and corrective industrial plant? We are waiting for you!',
            'fr' => "Vous avez de l'expérience dans le domaine des installations industrielles préventives et correctives ? Nous vous attendons !",
            'it' => 'Avete esperienza in impianti industriali preventivi e correttivi? Vi aspettiamo!',
        ];

        LanguageLine::create([
            'group' => 'TrabajaConNosotros',
            'key' => 'seccion1_fila1_texto1',
            'text' => $textos
        ]);

        $textos = [
            'es' => 'Operario de procesos industriales',
            'ca' => 'Operari de processos industrials',
            'en' => 'Industrial Process Operator',
            'fr' => 'Opérateur de procédés industriels',
            'it' => 'Operatore di processo industriale',
        ];

        LanguageLine::create([
            'group' => 'TrabajaConNosotros',
            'key' => 'seccion1_fila1_titulo2',
            'text' => $textos
        ]);

        $textos = [
            'es' => 'Tenemos en cuenta la opinión de nuestros colaboradores.',
            'ca' => "Tenim en compte l'opinió dels nostres col·laboradors.",
            'en' => 'We take into account the opinion of our collaborators.',
            'fr' => "Nous tenons compte de l'opinion de nos collaborateurs.",
            'it' => "Teniamo conto dell'opinione dei nostri collaboratori.",
        ];

        LanguageLine::create([
            'group' => 'TrabajaConNosotros',
            'key' => 'seccion1_fila1_texto2',
            'text' => $textos
        ]);

        $textos = [
            'es' => 'Técnicos',
            'ca' => 'Tècnics',
            'en' => 'Technical',
            'fr' => 'Technique',
            'it' => 'Tecnico',
        ];

        LanguageLine::create([
            'group' => 'TrabajaConNosotros',
            'key' => 'seccion1_fila1_titulo3',
            'text' => $textos
        ]);

        $textos = [
            'es' => ' Buscas la oportunidad de incorporarte en los departamentos de calidad, innovación y logística? Somos especialistas en soluciones técnicas.',
            'ca' => "Cerques l'oportunitat d'incorporar-te en els departaments de qualitat, innovació i logística? Som especialistes en solucions tècniques.",
            'en' => 'Are you looking for the opportunity to join the quality, innovation and logistics departments? We are specialists in technical solutions.',
            'fr' => "Vous êtes à la recherche d'une opportunité de rejoindre les départements qualité, innovation et logistique ? Nous sommes spécialisés dans les solutions techniques.",
            'it' => "Cercate l'opportunità di entrare a far parte dei reparti qualità, innovazione e logistica? Siamo specialisti in soluzioni tecniche.",
        ];

        LanguageLine::create([
            'group' => 'TrabajaConNosotros',
            'key' => 'seccion1_fila1_texto3',
            'text' => $textos
        ]);

        $textos = [
            'es' => 'Recursos Humanos',
            'ca' => 'Recursos Humans',
            'en' => 'Human Resources',
            'fr' => 'Ressources humaines',
            'it' => 'Risorse Umane',
        ];

        LanguageLine::create([
            'group' => 'TrabajaConNosotros',
            'key' => 'seccion1_fila2_titulo1',
            'text' => $textos
        ]);

        $textos = [
            'es' => ' Creemos en el talento. Buscamos colaboradores con actitut. Eres uno de ellos? Valoramos y desarrollamos la formación continúa.',
            'ca' => "Creiem en el talent. Busquem col·laboradors amb actitut. Ets un d'ells? Valorem i desenvolupem la formació continua.",
            'en' => 'We believe in talent. We are looking for collaborators with actitut. Are you one of them? We value and develop continuous training.',
            'fr' => "Nous croyons au talent. Nous recherchons des collaborateurs avec actitut. Êtes-vous l'un d'entre eux ? Nous valorisons et développons la formation continue.",
            'it' => 'Crediamo nel talento. Cerchiamo collaboratori con actitut. Sei uno di loro? Apprezziamo e sviluppiamo la formazione continua.',
        ];

        LanguageLine::create([
            'group' => 'TrabajaConNosotros',
            'key' => 'seccion1_fila2_texto1',
            'text' => $textos
        ]);

        $textos = [
            'es' => 'Comercial / Marketing',
            'ca' => 'Comercial / Màrqueting',
            'en' => 'Commercial / Marketing',
            'fr' => 'Commercial / Marketing',
            'it' => 'Commerciale / Marketing',
        ];

        LanguageLine::create([
            'group' => 'TrabajaConNosotros',
            'key' => 'seccion1_fila2_titulo2',
            'text' => $textos
        ]);

        $textos = [
            'es' => ' Practicamos la escucha activa para superar las expectativas de los clientes.',
            'ca' => " Practiquem l'escolta activa per a superar les expectatives dels clients.",
            'en' => ' We practice active listening to exceed customer expectations.',
            'fr' => " Nous pratiquons l'écoute active pour dépasser les attentes de nos clients.",
            'it' => " Noi pratichiamo l'ascolto attivo per superare le aspettative dei clienti.",
        ];

        LanguageLine::create([
            'group' => 'TrabajaConNosotros',
            'key' => 'seccion1_fila2_texto2',
            'text' => $textos
        ]);

        $textos = [
            'es' => 'Compras',
            'ca' => 'Compres',
            'en' => 'Shopping',
            'fr' => 'Achats',
            'it' => 'Shopping',
        ];

        LanguageLine::create([
            'group' => 'TrabajaConNosotros',
            'key' => 'seccion1_fila2_titulo3',
            'text' => $textos
        ]);

        $textos = [
            'es' => ' Nos adaptamos a los cambios del mercado. Somos flexibles a las tendencias.',
            'ca' => ' Ens adaptem als canvis del mercat. Som flexibles a les tendències.',
            'en' => ' We adapt to market changes. We are flexible to trends.',
            'fr' => ' Nous nous adaptons aux changements du marché. Nous sommes flexibles face aux tendances.',
            'it' => ' Ci adattiamo ai cambiamenti del mercato. Siamo flessibili alle tendenze.',
        ];

        LanguageLine::create([
            'group' => 'TrabajaConNosotros',
            'key' => 'seccion1_fila2_texto3',
            'text' => $textos
        ]);

        $textos = [
            'es' => '¡Así es nuestro Equipo!',
            'ca' => 'Així és el nostre Equip!',
            'en' => "That's our team!",
            'fr' => "C'est notre équipe !",
            'it' => "E' la nostra squadra!",
        ];

        LanguageLine::create([
            'group' => 'TrabajaConNosotros',
            'key' => 'seccion2_titulo',
            'text' => $textos
        ]);

        $textos = [
            'es' => $faker->text,
            'ca' => $faker->text,
            'en' => $faker->text,
            'fr' => $faker->text,
            'it' => $faker->text,
        ];

        LanguageLine::create([
            'group' => 'TrabajaConNosotros',
            'key' => 'section2_text',
            'text' => $textos
        ]);

        $textos = [
            'es' => 'Valores',
            'ca' => 'Valors',
            'en' => 'Values',
            'fr' => 'Valeurs',
            'it' => 'Valori',
        ];

        LanguageLine::create([
            'group' => 'TrabajaConNosotros',
            'key' => 'seccion2_imagenes_titulo1',
            'text' => $textos
        ]);

        $textos = [
            'es' => 'Nuestros valores sirven como eje de crecimiento en nuestra empresa.',
            'ca' => "Els nostres valors serveixen com a eix de creixement en la nostra empresa.",
            'en' => 'Our values serve as the axis of growth in our company.',
            'fr' => "Nos valeurs sont l'axe de croissance de notre entreprise.",
            'it' => "I nostri valori sono l'asse di crescita della nostra azienda.",
        ];

        LanguageLine::create([
            'group' => 'TrabajaConNosotros',
            'key' => 'seccion2_imagenes_subtitulo1',
            'text' => $textos
        ]);

        $textos = [
            'es' => 'Orientación al cliente',
            'ca' => 'Orientació al client',
            'en' => 'Customer orientation',
            'fr' => 'Orientation client',
            'it' => 'Orientamento al cliente',
        ];

        LanguageLine::create([
            'group' => 'TrabajaConNosotros',
            'key' => 'seccion2_imagenes_titulo2',
            'text' => $textos
        ]);

        $textos = [
            'es' => 'Compromiso',
            'ca' => 'Compromís',
            'en' => 'Commitment',
            'fr' => 'Engagement',
            'it' => "L'impegno",
        ];

        LanguageLine::create([
            'group' => 'TrabajaConNosotros',
            'key' => 'seccion2_imagenes_titulo3',
            'text' => $textos
        ]);

        $textos = [
            'es' => 'Proactividad',
            'ca' => 'Proactividad',
            'en' => 'Proactivity',
            'fr' => 'Proactivité',
            'it' => 'Proattività',
        ];

        LanguageLine::create([
            'group' => 'TrabajaConNosotros',
            'key' => 'seccion2_imagenes_titulo4',
            'text' => $textos
        ]);

        $textos = [
            'es' => 'Trabajo en equipo',
            'ca' => 'Treball en equip',
            'en' => 'Teamwork',
            'fr' => "Travail d'équipe",
            'it' => "Lavoro di squadra",
        ];

        LanguageLine::create([
            'group' => 'TrabajaConNosotros',
            'key' => 'seccion2_imagenes_titulo5',
            'text' => $textos
        ]);

        $textos = [
            'es' => 'I+D+I',
            'ca' => 'I+D+I',
            'en' => 'R&D&I',
            'fr' => 'R&D&I',
            'it' => 'R&D&I',
        ];

        LanguageLine::create([
            'group' => 'TrabajaConNosotros',
            'key' => 'seccion2_imagenes_titulo6',
            'text' => $textos
        ]);

        $textos = [
            'es' => 'Responsabilidad social y medioambiental',
            'ca' => 'Responsabilitat social i mediambiental',
            'en' => 'Social and environmental responsibility',
            'fr' => 'Responsabilité sociale et environnementale',
            'it' => 'Responsabilità sociale e ambientale',
        ];

        LanguageLine::create([
            'group' => 'TrabajaConNosotros',
            'key' => 'seccion2_imagenes_titulo7',
            'text' => $textos
        ]);

        $textos = [
            'es' => 'Pasión',
            'ca' => 'Passió',
            'en' => 'Passion',
            'fr' => 'Passion',
            'it' => 'Passione',
        ];

        LanguageLine::create([
            'group' => 'TrabajaConNosotros',
            'key' => 'seccion2_imagenes_titulo8',
            'text' => $textos
        ]);

        $textos = [
            'es' => 'Excelencia operativa',
            'ca' => 'Excel·lència operativa',
            'en' => 'Operational excellence',
            'fr' => 'Excellence opérationnelle',
            'it' => 'Eccellenza operativa',
        ];

        LanguageLine::create([
            'group' => 'TrabajaConNosotros',
            'key' => 'seccion2_imagenes_titulo9',
            'text' => $textos
        ]);

        $textos = [
            'es' => 'Historia',
            'ca' => 'Història',
            'en' => 'History',
            'fr' => 'Histoire',
            'it' => 'Storia',
        ];

        LanguageLine::create([
            'group' => 'TrabajaConNosotros',
            'key' => 'seccion2_imagenes_titulo10',
            'text' => $textos
        ]);

        $textos = [
            'es' => 'Nuestras ofertas de trabajo',
            'ca' => 'Les nostres ofertes de treball',
            'en' => "Our job offers",
            'fr' => "Nos offres d'emploi",
            'it' => "Le nostre offerte di lavoro",
        ];

        LanguageLine::create([
            'group' => 'TrabajaConNosotros',
            'key' => 'seccion3_titulo',
            'text' => $textos
        ]);

        $textos = [
            'es' => 'Regularmente vamos añadiendo ofertas de trabajo, si encuentras alguna que te interese no dudes al inscribirte.',
            'ca' => "Regularment anem afegint ofertes de treball, si trobes alguna que t'interessi no dubtis en inscriure't.",
            'en' => 'We regularly add job offers, if you find one that interests you do not hesitate to register.',
            'fr' => "Nous ajoutons régulièrement des offres d'emploi, si vous en trouvez une qui vous intéresse, n'hésitez pas à vous inscrire.",
            'it' => 'Aggiungiamo regolarmente offerte di lavoro, se ne trovi una che ti interessa non esitare a registrarti.',
        ];

        LanguageLine::create([
            'group' => 'TrabajaConNosotros',
            'key' => 'seccion3_subtitulo',
            'text' => $textos
        ]);

        $textos = [
            'es' => 'DESCRIPCIÓN',
            'ca' => 'DESCRIPCIÓ',
            'en' => 'DESCRIPTION',
            'fr' => 'DESCRIPTION',
            'it' => 'DESCRIZIONE',
        ];

        LanguageLine::create([
            'group' => 'TrabajaConNosotros',
            'key' => 'descripcion_oferta',
            'text' => $textos
        ]);

        $textos = [
            'es' => 'INFORMACIÓN ADICIONAL',
            'ca' => 'INFORMACIÓ ADDICIONAL',
            'en' => 'FURTHER INFORMATION',
            'fr' => 'INFORMATIONS COMPLÉMENTAIRES',
            'it' => 'ULTERIORI INFORMAZIONI',
        ];

        LanguageLine::create([
            'group' => 'TrabajaConNosotros',
            'key' => 'offer_aditional_info',
            'text' => $textos
        ]);

        $textos = [
            'es' => 'Tiempo',
            'ca' => 'Temps',
            'en' => 'Time',
            'fr' => 'Temps',
            'it' => 'Tempo',
        ];

        LanguageLine::create([
            'group' => 'TrabajaConNosotros',
            'key' => 'tiempo_de_oferta',
            'text' => $textos
        ]);

        $textos = [
            'es' => 'Salario',
            'ca' => 'Salari',
            'en' => 'Salary',
            'fr' => 'Salaire',
            'it' => 'Stipendio',
        ];

        LanguageLine::create([
            'group' => 'TrabajaConNosotros',
            'key' => 'salario_oferta',
            'text' => $textos
        ]);

        $textos = [
            'es' => 'Duración',
            'ca' => 'Durada',
            'en' => 'Duration',
            'fr' => 'Durée du projet',
            'it' => 'Durata',
        ];

        LanguageLine::create([
            'group' => 'TrabajaConNosotros',
            'key' => 'duracion_oferta',
            'text' => $textos
        ]);

        $textos = [
            'es' => 'Lugar',
            'ca' => 'Lloc',
            'en' => 'Place',
            'fr' => 'Lieu',
            'it' => 'Posto',
        ];

        LanguageLine::create([
            'group' => 'TrabajaConNosotros',
            'key' => 'lugar_de_la_oferta',
            'text' => $textos
        ]);

        $textos = [
            'es' => 'REQUISITOS',
            'ca' => 'REQUISITS',
            'en' => 'REQUIREMENTS',
            'fr' => 'EXIGENCES',
            'it' => 'RICHIESTE',
        ];

        LanguageLine::create([
            'group' => 'TrabajaConNosotros',
            'key' => 'requerimiento_oferta',
            'text' => $textos
        ]);

        $textos = [
            'es' => 'Inscríbete a la oferta',
            'ca' => "Inscriu-te a l'oferta",
            'en' => 'Subscribe to the offer',
            'fr' => "Abonnez-vous à l'offre",
            'it' => "Iscriviti all'offerta",
        ];

        LanguageLine::create([
            'group' => 'TrabajaConNosotros',
            'key' => 'formulario_oferta_titulo',
            'text' => $textos
        ]);

        $textos = [
            'es' => 'Envíanos tu CV',
            'ca' => "Envia'ns el teu CV",
            'en' => 'Send us your CV',
            'fr' => 'Envoyez-nous votre CV',
            'it' => 'Inviaci il tuo CV',
        ];

        LanguageLine::create([
            'group' => 'TrabajaConNosotros',
            'key' => 'formulario1_oferta_titulo',
            'text' => $textos
        ]);

        $textos = [
            'es' => 'Si quieres formar parte de nuestro equipo esta se tu oportunidad. Podrás escoger la sección donde más te interesa formar parte. Los currículums se tienen que enviar en formato word, .txt o .pdf',
            'ca' => "Si vols formar part del nostre equip aquesta es la teva oportunitat. Podràs triar la secció on més t'interessa formar part. Els currículums s'han d'enviar en format word, .txt o .pdf",
            'en' => 'If you want to be part of our team this is your chance. You will be able to choose the section where you are most interested in being part of our team. Resumes must be sent in word, .txt or .pdf format.',
            'fr' => "Si vous voulez faire partie de notre équipe, c'est votre chance. Vous pourrez choisir la section où vous êtes le plus intéressé à faire partie de notre équipe. Les curriculum vitae doivent être envoyés en format word, .txt ou .pdf.",
            'it' => 'Se vuoi far parte del nostro team, questa è la tua occasione. Potrai scegliere la sezione in cui sei più interessato a far parte del nostro team. I curricula devono essere inviati in formato word, .txt o .pdf.',
        ];

        LanguageLine::create([
            'group' => 'TrabajaConNosotros',
            'key' => 'formulario1_oferta_texto1',
            'text' => $textos
        ]);

        $textos = [
            'es' => 'Nombre',
            'ca' => 'Nom',
            'en' => 'First name',
            'fr' => 'Prénom',
            'it' => 'Nome',
        ];

        LanguageLine::create([
            'group' => 'TrabajaConNosotros',
            'key' => 'oferta_formulario_input1',
            'text' => $textos
        ]);

        $textos = [
            'es' => 'Apellidos',
            'ca' => 'Cognoms',
            'en' => 'Surname',
            'fr' => 'Nom de famille',
            'it' => 'Cognome',
        ];

        LanguageLine::create([
            'group' => 'TrabajaConNosotros',
            'key' => 'oferta_formulario_input2',
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
            'group' => 'TrabajaConNosotros',
            'key' => 'oferta_formulario_input3',
            'text' => $textos
        ]);

        $textos = [
            'es' => 'Teléfono',
            'ca' => 'Telèfon',
            'en' => 'Telephone',
            'fr' => 'Téléphone',
            'it' => 'Telefono',
        ];

        LanguageLine::create([
            'group' => 'TrabajaConNosotros',
            'key' => 'oferta_formulario_input4',
            'text' => $textos
        ]);

        $textos = [
            'es' => 'Añadir CV',
            'ca' => 'Afegir CV',
            'en' => 'Add CV',
            'fr' => 'Ajouter CV',
            'it' => 'Aggiungi CV',
        ];

        LanguageLine::create([
            'group' => 'TrabajaConNosotros',
            'key' => 'oferta_formulario_input_file_titulo',
            'text' => $textos
        ]);

        $textos = [
            'es' => 'Peso máximo de 4MB. Archivos permitidos: word, pdf, txt',
            'ca' => 'Pes màxim de 4MB. Arxius permesos: word, pdf, txt',
            'en' => 'Maximum weight of 4MB. Permitted files: word, pdf, txt',
            'fr' => 'Poids maximum de 4MB. Fichiers autorisés : word, pdf, txt',
            'it' => 'Peso massimo di 4MB. File consentiti: word, pdf, txt',
        ];

        LanguageLine::create([
            'group' => 'TrabajaConNosotros',
            'key' => 'oferta_formulario_input_file',
            'text' => $textos
        ]);

        $textos = [
            'es' => 'He leído y acepto la <a href="{{LaravelLocalization::getURLFromRouteNameTranslated(App::getLocale(),\'routes.politic_pages.politic_privacy\')}}" target="_blank">política de privacidad</a>',
            'ca' => 'He llegit i accepto la <a href="{{LaravelLocalization::getURLFromRouteNameTranslated(App::getLocale(),\'routes.politic_pages.politic_privacy\')}}" target="_blank">política de privacitat</a>',
            'en' => 'I have read and accept the <a href="{{LaravelLocalization::getURLFromRouteNameTranslated(App::getLocale(),\'routes.politic_pages.politic_privacy\')}}" target="_blank">privacy policy</a>',
            'fr' => "J'ai lu et j'accepte la politique de confidentialité <a href=\"{{LaravelLocalization::getURLFromRouteNameTranslated(App::getLocale(),\'routes.politic_pages.politic_privacy\')}}\" target=\"_blank\">privacy policy</a>",
            'it' => 'Ho letto e accetto la <a href="{{LaravelLocalization::getURLFromRouteNameTranslated(App::getLocale(),\'routes.politic_pages.politic_privacy\')}}" target="_blank">l\'informativa sulla privacy</a>',
        ];

        LanguageLine::create([
            'group' => 'TrabajaConNosotros',
            'key' => 'oferta_formulario_checkboc_politicas',
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
            'group' => 'TrabajaConNosotros',
            'key' => 'oferta_formulario_boton',
            'text' => $textos
        ]);

        $textos = [
            'es' => 'ENVÍO REALIZADO',
            'ca' => 'ENVIAMENT REALITZAT',
            'en' => 'SHIPMENT MADE',
            'fr' => 'EXPÉDITION FABRIQUÉE',
            'it' => 'SPEDIZIONI EFFETTUATE',
        ];

        LanguageLine::create([
            'group' => 'TrabajaConNosotros',
            'key' => 'guadado_formulario_titulo',
            'text' => $textos
        ]);

        $textos = [
            'es' => 'Gracias ',
            'ca' => 'Gràcies',
            'en' => 'Thank you',
            'fr' => 'Je vous remercie',
            'it' => 'Grazie',
        ];

        LanguageLine::create([
            'group' => 'TrabajaConNosotros',
            'key' => 'guadado_formulario_texto1',
            'text' => $textos
        ]);

        $textos = [
            'es' => 'por contactar con nosotros.',
            'ca' => 'per contactar amb nosaltres.',
            'en' => 'for contacting us.',
            'fr' => 'pour nous contacter.',
            'it' => 'per averci contattato.',
        ];

        LanguageLine::create([
            'group' => 'TrabajaConNosotros',
            'key' => 'stored_form_text1_parte2',
            'text' => $textos
        ]);

        $textos = [
            'es' => 'En breve contactaremos con usted.',
            'ca' => 'En breu contactarem amb vostè.',
            'en' => 'We will contact you shortly.',
            'fr' => 'Nous vous contacterons dans les plus brefs délais.',
            'it' => 'Vi contatteremo a breve.',
        ];

        LanguageLine::create([
            'group' => 'TrabajaConNosotros',
            'key' => 'stored_form_text2',
            'text' => $textos
        ]);
    }
}