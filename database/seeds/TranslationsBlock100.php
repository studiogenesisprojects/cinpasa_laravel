<?php

use Illuminate\Database\Seeder;
use Spatie\TranslationLoader\LanguageLine;

class TranslationsBlock100 extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $textos = [
            'es' => 'Liasa cumple 100 años',
            'ca' => 'Liasa compleix 100 anys',
            'en' => 'Liasa celebrates 100 years',
            'fr' => 'Liasa fête ses 100 ans',
            'it' => 'Liasa festeggia i 100 anni',
        ];

        LanguageLine::create([
            'group' => 'Bloque100',
            'key' => 'titulo',
            'text' => $textos
        ]);

        $textos = [
            'es' => 'Evolucionando desde 1918',
            'ca' => 'Evolucionant des de 1918',
            'en' => 'Evolving since 1918',
            'fr' => 'Évolution depuis 1918',
            'it' => 'In evoluzione dal 1918',
        ];

        LanguageLine::create([
            'group' => 'Bloque100',
            'key' => 'subtitulo',
            'text' => $textos
        ]);

        $textos = [
            'es' => '¿Preparado para viajar en el tiempo?',
            'ca' => 'Preparat per a viatjar en el temps?',
            'en' => 'Ready to travel back in time?',
            'fr' => 'Prêt à voyager dans le temps ?',
            'it' => 'Pronto a tornare indietro nel tempo?',
        ];

        LanguageLine::create([
            'group' => 'Bloque100',
            'key' => 'seccion1_titulo',
            'text' => $textos
        ]);

        $textos = [
            'es' => 'Te proponemos un recorrido por la historia de LIASA La Industrial Algodonera para descubrir los momentos más importantes de la empresa. Fez click en cada uno de ellos para ampliar información.',
            'ca' => "Et proposem un recorregut per la història de LIASA La Industrial Cotonera per a descobrir els moments més importants de l'empresa. Fes clic en cadascun d'ells per a ampliar informació.",
            'en' => "We propose you a journey through the history of LIASA La Industrial Algodonera to discover the most important moments of the company. Fez click on each of them for more information.",
            'fr' => "Nous vous proposons un voyage à travers l'histoire de LIASA La Industrial Algodonera pour découvrir les moments les plus importants de l'entreprise. Fès clique sur chacun d'eux pour plus d'informations.",
            'it' => "Vi proponiamo un viaggio nella storia di LIASA La Industrial Algodonera per scoprire i momenti più importanti dell'azienda. Fez clicca su ciascuno di essi per maggiori informazioni.",
        ];

        LanguageLine::create([
            'group' => 'Bloque100',
            'key' => 'seccion1_subtitulo',
            'text' => $textos
        ]);

        $textos = [
            'es' => "La historia de LIASA La Industrial Algodonera como fabricante de cordones, cordones elásticos, cintas e hilo de polipropileno, se tiene que entender como una evolución a doble vía: por un lado tenemos la actividad empresarial de la familia Cabré-Cogul y por otro lado la creación de una sociedad mercantil que acabará siendo de su propiedad y que le dará el nombre definitivo.",
            'ca' => 'La història de LIASA La Industrial Cotonera com a fabricant de cordons, cordons elàstics, cintes i fil de polipropilè, s’ha d’entendre com una evolució a doble via: d’una banda tenim l’activitat empresarial de la família Cabré-Cogul i d’altra banda la creació d’una societat mercantil que acabarà sent de la seva propietat i que li donarà el nom definitiu.',
            'en' => 'The history of LIASA La Industrial Algodonera as a manufacturer of cords, elastic cords, ribbons and polypropylene thread, has to be understood as a two-way evolution: on the one hand we have the business activity of the Cabré-Cogul family and on the other hand the creation of a mercantile society that will end up being their property and will give it its definitive name.',
            'fr' => "L'histoire de LIASA La Industrial Algodonera en tant que fabricant de cordons, cordes élastiques, rubans et fils de polypropylène, doit être comprise comme une évolution à double sens : d'une part l'activité commerciale de la famille Cabré-Cogul et d'autre part la création d'une société marchande qui deviendra leur propriété et lui donnera sa dénomination définitive.",
            'it' => "La storia di LIASA La Industrial Algodonera come produttore di cordoni, cordoni elastici, nastri e fili di polipropilene, va intesa come un'evoluzione a due sensi: da un lato abbiamo l'attività commerciale della famiglia Cabré-Cogul e dall'altro la creazione di una società mercantile che finirà per essere loro proprietà e le darà il nome definitivo.",
        ];

        LanguageLine::create([
            'group' => 'Bloque100',
            'key' => 'seccion1_texto1',
            'text' => $textos
        ]);

        $textos = [
            'es' => 'Las etapas cronológicas se han presentado siguiendo las cuatro generaciones durante estos 100 años.',
            'ca' => 'Les etapes cronològiques s’han presentat seguint les quatre generacions durant aquests 100 anys.',
            'en' => 'The chronological stages have been presented following the four generations during these 100 years.',
            'fr' => 'Les étapes chronologiques ont été présentées en suivant les quatre générations au cours de ces 100 ans.',
            'it' => 'Le fasi cronologiche sono state presentate seguendo le quattro generazioni di questi 100 anni.',
        ];

        LanguageLine::create([
            'group' => 'Bloque100',
            'key' => 'seccion1_texto2',
            'text' => $textos
        ]);

        $textos = [
            'es' => '¿Sabías qué...',
            'ca' => '¿Sabías qué...',
            'en' => 'Did you know that...',
            'fr' => 'Saviez-vous que...',
            'it' => 'Sapevi che...',
        ];

        LanguageLine::create([
            'group' => 'Bloque100',
            'key' => 'seccion2_titulo',
            'text' => $textos
        ]);


        $textos = [
            'es' => 'Más información',
            'ca' => 'Més informació',
            'en' => 'More information',
            'fr' => "Plus d'informations",
            'it' => "Maggiori informazioni",
        ];

        LanguageLine::create([
            'group' => 'Bloque100',
            'key' => 'seccion2_linea_del_tiempo_boton',
            'text' => $textos
        ]);

        $textos = [
            'es' => '¿Sabías que LIASA La Industrial Algodonera lleva más de 80 años exportando?',
            'ca' => 'Sabies que LIASA La Industrial Cotonera porta més de 80 anys exportant?',
            'en' => "Did you know that LIASA La Industrial Algodonera has been exporting for more than 80 years?",
            'fr' => "Saviez-vous que LIASA La Industrial Algodonera exporte depuis plus de 80 ans ?",
            'it' => 'Sapevate che LIASA La Industrial Algodonera esporta da oltre 80 anni?',
        ];

        LanguageLine::create([
            'group' => 'Bloque100',
            'key' => 'seccion2_modal1_titulo',
            'text' => $textos
        ]);

        $textos = [
            'es' => 'Se conserva documentación del 1936 con los trámites burocráticos para exportar a Chile. Los documentos están aprobados por el Comité Industrial Algodonero que era quién regulaba el comercio durante la guerra civil. ',
            'ca' => "Es conserva documentació del 1936 amb els tràmits burocràtics per a exportar a Xile. Els documents estan aprovats pel Comitè Industrial Cotoner que era qui regulava el comerç durant la guerra civil.",
            'en' => 'Documentation from 1936 is kept with the bureaucratic procedures for exporting to Chile. The documents are approved by the Cotton Industrial Committee that regulated the trade during the civil war. ',
            'fr' => "La documentation de 1936 est conservée avec les procédures bureaucratiques d'exportation vers le Chili. Les documents sont approuvés par le Comité industriel du coton qui a réglementé le commerce pendant la guerre civile. ",
            'it' => "La documentazione del 1936 è conservata con le procedure burocratiche per l'esportazione in Cile. I documenti sono approvati dal Comitato Industriale del Cotone che ha regolato il commercio durante la guerra civile. ",
        ];

        LanguageLine::create([
            'group' => 'Bloque100',
            'key' => 'seccion2_modal1_subtitulo',
            'text' => $textos
        ]);

        $textos = [
            'es' => '¿Sabías que en 1935 LIASA ya tenía muestrario propio de hilo de algodón con 16 colores diferentes?',
            'ca' => 'Sabies que en 1935 LIASA ja tenia mostrari propi de fil de cotó amb 16 colors diferents?',
            'en' => "Did you know that in 1935 LIASA already had its own sample book of cotton yarn with 16 different colours?",
            'fr' => "Saviez-vous qu'en 1935, LIASA avait déjà son propre livre d'échantillons de fils de coton avec 16 couleurs différentes ?",
            'it' => 'Lo sapevate che nel 1935 LIASA aveva già il proprio campionario di filati di cotone con 16 colori diversi?',
        ];

        LanguageLine::create([
            'group' => 'Bloque100',
            'key' => 'seccion2_modal2_titulo',
            'text' => $textos
        ]);

        $textos = [
            'es' => 'Había un muestrario de hilo extra fuerte dedo «El Indio» especial para la fabricación del calzado. Se bañaba con suavizante para facilitar el trabajo de coser el calzado.',
            'ca' => "Hi havia un mostrari de fil extra fort dit «L'Indi» especial per a la fabricació del calçat. Es banyava amb suavitzant per a facilitar el treball de cosir el calçat.",
            'en' => 'There was a sampler of extra strong thread toe "The Indian" special for the manufacture of footwear. It was bathed with softener to facilitate the work of sewing the footwear.',
            'fr' => "Il y avait un échantillonneur d'orteil de fil extra fort \"L'Indien\" spécial pour la fabrication de chaussures. Il a été baigné d'adoucissant pour faciliter le travail de couture de la chaussure.",
            'it' => "C'era un campionatore di punta di filo extra forte \"The Indian\" speciale per la produzione di calzature. E 'stato bagnato con ammorbidente per facilitare il lavoro di cucitura delle calzature.",
        ];

        LanguageLine::create([
            'group' => 'Bloque100',
            'key' => 'seccion2_modal2_subtitulo',
            'text' => $textos
        ]);

        $textos = [
            'es' => '¿Sabías que en los años 60 LIASA La Industrial Algodonera empezó a diversificar en sistemas de cierre y aislamiento con cordones para persianas y rieles para cortinas? ',
            'ca' => 'Sabies que en els anys 60 LIASA La Industrial Cotonera va començar a diversificar en sistemes de tancament i aïllament amb cordons per a persianes i rieles per a cortines?',
            'en' => "Did you know that in the 1960's LIASA Industrial Cotton began to diversify into lace closure and insulation systems for blinds and curtain rails? ",
            'fr' => "Saviez-vous que dans les années 1960, LIASA Industrial Cotton a commencé à se diversifier dans les systèmes de fermeture à cordon et d'isolation pour les stores et les tringles à rideaux ? ",
            'it' => "Lo sapevate che negli anni '60 la LIASA Industrial Cotton ha iniziato a diversificare la sua produzione in sistemi di chiusura e isolamento per tende e binari per tende? ",
        ];

        LanguageLine::create([
            'group' => 'Bloque100',
            'key' => 'seccion2_modal3_titulo',
            'text' => $textos
        ]);

        $textos = [
            'es' => 'Con el paso de los años fue ampliando su I+D hasta llegar a los productos de hoy en día. ',
            'ca' => "Amb el pas dels anys va anar ampliant la seva I+D fins a arribar als productes d'avui dia.",
            'en' => 'Over the years it has expanded its R&D to the products of today. ',
            'fr' => "Au fil des ans, elle a étendu ses activités de recherche et développement aux produits d'aujourd'hui. ",
            'it' => "Nel corso degli anni ha esteso la sua ricerca e sviluppo ai prodotti di oggi. ",
        ];

        LanguageLine::create([
            'group' => 'Bloque100',
            'key' => 'seccion2_modal3_subtitulo',
            'text' => $textos
        ]);

        $textos = [
            'es' => '¿Sabías que LIASA se avanza a las tendencias desde sus inicios? ',
            'ca' => "Sabies que LIASA s'avança a les tendències des dels seus inicis?",
            'en' => "Did you know that LIASA has been moving with the trends since the beginning?",
            'fr' => "Saviez-vous que la LIASA a suivi les tendances depuis sa création ? ",
            'it' => 'Sapevate che LIASA si è mossa con le tendenze sin dalla sua nascita? ',
        ];

        LanguageLine::create([
            'group' => 'Bloque100',
            'key' => 'seccion2_modal4_titulo',
            'text' => $textos
        ]);

        $textos = [
            'es' => "Ejemplos de ello son la fabricación de corbatas de punto ya en los años 20 o el lanzamiento en 1968 de la línea de cordones elásticos en espiral LIAFLEX, anticipando la demanda de calzado fácil de sujetar y sin tener que atar, muy práctico para niños o personas con dificultades motrices. ",
            'ca' => "Exemples d'això són la fabricació de corbates de punt ja en els anys 20 o el llançament en 1968 de la línia de cordons elàstics en espiral LIAFLEX, anticipant la demanda de calçat fàcil de subjectar i sense haver de lligar, molt pràctic per a nens o persones amb dificultats motrius.",
            'en' => "Examples of this are the manufacture of knitted ties already in the 1920s or the launch in 1968 of the LIAFLEX line of spiral elastic laces, anticipating the demand for footwear that is easy to hold and does not have to be tied, very practical for children or people with motor difficulties.",
            'fr' => "On peut citer comme exemple la fabrication de cravates tricotées dès les années 20 ou le lancement en 1968 de la ligne LIAFLEX de lacets élastiques en spirale, anticipant la demande de chaussures faciles à attacher sans avoir à les nouer, très pratiques pour les enfants ou les personnes ayant des difficultés motrices. ",
            'it' => "Ne sono un esempio la produzione di cravatte a maglia già negli anni '20 o il lancio nel 1968 della linea di lacci elastici a spirale LIAFLEX, anticipando la richiesta di scarpe facili da allacciare senza doverle legare, molto pratiche per bambini o persone con difficoltà motorie. ",
        ];

        LanguageLine::create([
            'group' => 'Bloque100',
            'key' => 'seccion2_modal4_subtitulo',
            'text' => $textos
        ]);

        $textos = [
            'es' => '¿Sabías que como especialistas en packaging te ayudamos a marcar la diferencia?',
            'ca' => "Sabies que com a especialistes en embalatge t'ajudem a marcar la diferència?",
            'en' => "Did you know that as packaging specialists we help you make a difference?",
            'fr' => "Saviez-vous qu'en tant que spécialistes de l'emballage, nous vous aidons à faire la différence ?",
            'it' => 'Sapevate che come specialisti del packaging vi aiutiamo a fare la differenza?',
        ];

        LanguageLine::create([
            'group' => 'Bloque100',
            'key' => 'seccion2_modal5_titulo',
            'text' => $textos
        ]);

        $textos = [
            'es' => 'Contamos con un catálogo de cordones matizados de 16 diseños distintos ¡ideales para asas de bolsa! Además, como fabricantes, podemos personalizar tu cordón con la combinación de colores que desees. ',
            'ca' => "Comptem amb un catàleg de cordons matisats de 16 dissenys diferents ideals per a anses de bossa! A més, com a fabricadors, podem personalitzar el teu cordó amb la combinació de colors que desitgis.",
            'en' => 'We have a catalogue of laces with 16 different designs, ideal for bag handles! Also, as manufacturers, we can customize your lace with the combination of colors you want. ',
            'fr' => "Nous avons un catalogue de lacets avec 16 modèles différents, idéal pour les poignées de sacs ! De plus, en tant que fabricant, nous pouvons personnaliser votre dentelle avec la combinaison de couleurs que vous désirez. ",
            'it' => "Abbiamo un catalogo di pizzi con 16 diversi design, ideali per i manici delle borse! Inoltre, come produttori, possiamo personalizzare il vostro pizzo con la combinazione di colori che desiderate. ",
        ];

        LanguageLine::create([
            'group' => 'Bloque100',
            'key' => 'seccion2_modal5_subtitulo',
            'text' => $textos
        ]);

        $textos = [
            'es' => '¿Sabías que llevamos más de 30 años ofreciendo soluciones con navet metálico?',
            'ca' => 'Sabies que portem més de 30 anys oferint solucions amb navet metàl·lic?',
            'en' => "Did you know that we have been offering solutions with navet metal for over 30 years?",
            'fr' => "Saviez-vous que nous offrons des solutions avec le métal navet depuis plus de 30 ans ?",
            'it' => 'Sapevate che da oltre 30 anni offriamo soluzioni con il metallo navet?',
        ];

        LanguageLine::create([
            'group' => 'Bloque100',
            'key' => 'seccion2_modal6_titulo',
            'text' => $textos
        ]);

        $textos = [
            'es' => 'Ya en los años 80 fabricábamos con este terminal. A lo largo de las décadas hemos mejorado la técnica de fabricación y ampliado las aplicaciones de este producto. ',
            'ca' => 'Ja en els anys 80 fabricàvem amb aquest terminal. Al llarg de les dècades hem millorat la tècnica de fabricació i ampliat les aplicacions d\'aquest producte.',
            'en' => "Back in the '80s, we were making with this terminal. Over the decades we have improved the manufacturing technology and expanded the applications of this product. ",
            'fr' => "Dans les années 80, on faisait avec ce terminal. Au fil des décennies, nous avons amélioré la technologie de fabrication et élargi les applications de ce produit. ",
            'it' => "Negli anni '80, facevamo con questo terminale. Nel corso dei decenni abbiamo migliorato la tecnologia di produzione e ampliato le applicazioni di questo prodotto. ",
        ];

        LanguageLine::create([
            'group' => 'Bloque100',
            'key' => 'seccion2_modal6_subtitulo',
            'text' => $textos
        ]);

        $textos = [
            'es' => '¿Sabías que antes de ser constituida como Sociedad Anónima LIASA ya llevaba fabricando unos años? ',
            'ca' => 'Sabies que abans de ser constituïda com a Societat Anònima LIASA ja portava fabricant uns anys',
            'en' => "Did you know that before it was incorporated as a limited company LIASA had already been manufacturing for a few years? ",
            'fr' => "Saviez-vous qu'avant d'être constituée en société LIASA, elle fabriquait déjà depuis quelques années ? ",
            'it' => "Sapevate che prima di essere incorporata come LIASA Corporation produceva già da qualche anno? ",
        ];

        LanguageLine::create([
            'group' => 'Bloque100',
            'key' => 'seccion2_modal7_titulo',
            'text' => $textos
        ]);

        $textos = [
            'es' => 'Esta actividad emprendedora se la debemos a nuestra fundadora, EmparCogul. Nos consta que a finales del siglo XIX ya fabricaba calcetines en casa. ',
            'ca' => 'Aquesta activitat emprenedora la hi devem a la nostra fundadora, EmparCogul. Ens consta que a la fi del segle XIX ja fabricava mitjons a casa.',
            'en' => "We owe this entrepreneurial activity to our founder, EmparCogul. We know that at the end of the 19th century she was already making socks at home. ",
            'fr' => "Nous devons cette activité entrepreneuriale à notre fondateur, EmparCogul. Nous savons qu'à la fin du 19ème siècle, elle fabriquait déjà des chaussettes à la maison.",
            'it' => 'Dobbiamo questa attività imprenditoriale al nostro fondatore, EmparCogul. Sappiamo che già alla fine del XIX secolo faceva i calzini in casa. ',
        ];

        LanguageLine::create([
            'group' => 'Bloque100',
            'key' => 'seccion2_modal7_subtitulo',
            'text' => $textos
        ]);

        $textos = [
            'es' => '¿Sabías que durante años LIASA hacía su propio packaging?',
            'ca' => 'Sabies que durant anys LIASA feia el seu propi embalatge?',
            'en' => "Did you know that for years LIASA made its own packaging?",
            'fr' => "Saviez-vous que pendant des années, LIASA a fabriqué ses propres emballages ?",
            'it' => 'Lo sapevate che per anni LIASA ha realizzato i propri imballaggi?',
        ];

        LanguageLine::create([
            'group' => 'Bloque100',
            'key' => 'seccion2_modal8_titulo',
            'text' => $textos
        ]);

        $textos = [
            'es' => 'El año 1954 LIASA creó su propia imprenta para cubrir las necesidades internas de impresión de etiquetas e información de productos. También tenía máquinas para hacer sus propias cajas de producto.  La actividad cesó el 1977. ',
            'ca' => "L'any 1954 LIASA va crear la seva pròpia impremta per a cobrir les necessitats internes d'impressió d'etiquetes i informació de productes. També tenia màquines per a fer les seves pròpies caixes de producte.  L'activitat va cessar el 1977.",
            'en' => 'In 1954 LIASA set up its own printing plant to cover the internal needs of label printing and product information. It also had machines to make its own product boxes.  The activity ceased in 1977. ',
            'fr' => "En 1954, LIASA a créé sa propre imprimerie pour couvrir les besoins internes d'impression d'étiquettes et d'informations sur les produits. Elle disposait également de machines pour fabriquer ses propres boîtes de produits.  L'activité a cessé en 1977. ",
            'it' => "Nel 1954 LIASA ha creato un proprio stabilimento di stampa per coprire le esigenze interne di stampa di etichette e informazioni sui prodotti. Aveva anche macchine per realizzare le proprie scatole di prodotti.  L'attività è cessata nel 1977. ",
        ];

        LanguageLine::create([
            'group' => 'Bloque100',
            'key' => 'seccion2_modal8_subtitulo',
            'text' => $textos
        ]);

        $textos = [
            'es' => '¿Sabías que LIASA es una empresa familiar y ésta es la 4ª generación al frente del negocio?',
            'ca' => 'Sabies que LIASA és una empresa familiar i aquesta és la 4a generació al capdavant del negoci?',
            'en' => "Did you know that LIASA is a family business and this is the 4th generation at the head of the business?",
            'fr' => "Saviez-vous que LIASA est une entreprise familiale et que c'est la 4e génération à la tête de l'entreprise ?",
            'it' => 'Lo sapevate che la LIASA è un\'azienda a conduzione familiare e che questa è la quarta generazione a capo dell\'azienda?',
        ];

        LanguageLine::create([
            'group' => 'Bloque100',
            'key' => 'seccion2_modal9_titulo',
            'text' => $textos
        ]);

        $textos = [
            'es' => 'El último relevo generacional conllevó algunos cambios estratégicos como especializarse en soluciones y acabados para Artes Gráficas y Packaging. ',
            'ca' => "L'últim relleu generacional va comportar alguns canvis estratègics com especialitzar-se en solucions i acabats per a Arts Gràfiques i Embalatge.",
            'en' => 'The last generational change brought some strategic changes such as specializing in solutions and finishes for Graphic Arts and Packaging. ',
            'fr' => "Le dernier changement de génération a entraîné quelques changements stratégiques tels que la spécialisation dans les solutions et les finitions pour les Arts Graphiques et le Packaging. ",
            'it' => "L'ultimo cambio generazionale ha portato alcuni cambiamenti strategici come la specializzazione in soluzioni e finiture per le Arti Grafiche e il Packaging. ",
        ];

        LanguageLine::create([
            'group' => 'Bloque100',
            'key' => 'seccion2_modal9_subtitulo',
            'text' => $textos
        ]);

        $textos = [
            'es' => '¿Sabías que el Gremio de Cinteros existe desde el siglo XVI? ',
            'ca' => 'Sabies que el Gremi de Cinteros existeix des del segle XVI?',
            'en' => "Did you know that the Guild of Interpreters has existed since the 16th century? ",
            'fr' => "Saviez-vous que la Guilde des Interprètes existe depuis le 16ème siècle ? ",
            'it' => 'Sapevate che la Gilda degli Interpreti esiste dal XVI secolo? ',
        ];

        LanguageLine::create([
            'group' => 'Bloque100',
            'key' => 'seccion2_modal10_titulo',
            'text' => $textos
        ]);

        $textos = [
            'es' => 'Es la asociación estatal de fabricantes de tejido estrecho (menos de 30cm). LIASA es miembro del gremio desde hace más de 50 años y parte integrante de la junta directiva des de 1983. ',
            'ca' => "És l'associació estatal de fabricants de teixit estret (menys de 30cm). LIASA és membre del gremi des de fa més de 50 anys i part integrant de la junta directiva donis de 1983.",
            'en' => 'It is the state association of narrow fabric manufacturers (less than 30cm). LIASA has been a member of the association for more than 50 years and has been a member of the board of directors since 1983. ',
            'fr' => "C'est l'association d'état des fabricants de tissus étroits (moins de 30cm). La LIASA est membre de l'association depuis plus de 50 ans et est membre du conseil d'administration depuis 1983. ",
            'it' => "È l'associazione statale dei produttori di tessuti stretti (meno di 30 cm). LIASA è membro dell'associazione da oltre 50 anni e fa parte del consiglio direttivo dal 1983. ",
        ];

        LanguageLine::create([
            'group' => 'Bloque100',
            'key' => 'seccion2_modal10_subtitulo',
            'text' => $textos
        ]);

        $textos = [
            'es' => '¿Sabías que LIASA creó su propia tintorería para tintar hilo? ',
            'ca' => "Sabies que LIASA va crear la seva pròpia tintoreria per a tintar fil?",
            'en' => 'Did you know that LIASA has set up its own yarn dyeing shop? ',
            'fr' => "Saviez-vous que la LIASA a créé sa propre teinturerie de fil ? ",
            'it' => "Sapevate che LIASA ha aperto una propria tintoria di filati? ",
        ];

        LanguageLine::create([
            'group' => 'Bloque100',
            'key' => 'seccion2_modal11_titulo',
            'text' => $textos
        ]);

        $textos = [
            'es' => 'Desde sus inicios la empresa siempre tuvo instalaciones dedicadas a esta actividad hasta que el año 1970 trasladó la unidad a un espacio independiente. Se creó así una nueva sociedad: AUTEX, Auxiliar Textil. ',
            'ca' => "Des dels seus inicis l'empresa sempre va tenir instal·lacions dedicades a aquesta activitat fins que l'any 1970 va traslladar la unitat a un espai independent. Es va crear així una nova societat: AUTEX, Auxiliar Tèxtil.",
            'en' => 'From the beginning the company always had facilities dedicated to this activity until the year 1970 when it moved the unit to an independent space. A new company was thus created: AUTEX, Auxiliar Textil. ',
            'fr' => "Dès le début, l'entreprise a toujours eu des installations dédiées à cette activité jusqu'en 1970, année où elle a déménagé dans un local indépendant. Une nouvelle société a donc été créée : AUTEX, Auxiliar Textil. ",
            'it' => "Fin dall'inizio l'azienda ha sempre avuto strutture dedicate a questa attività fino al 1970, quando ha spostato l'unità in uno spazio indipendente. È stata così creata una nuova società: AUTEX, Auxiliar Textil. ",
        ];

        LanguageLine::create([
            'group' => 'Bloque100',
            'key' => 'seccion2_modal11_subtitulo',
            'text' => $textos
        ]);

        $textos = [
            'es' => '¿Sabías que el primer producto fabricado con algodón de LIASA La Industrial Algodonera fue la madeja de hilo para la confección manual de calcetines? ',
            'ca' => 'Sabies que el primer producte fabricat amb cotó de LIASA La Industrial Cotonera va ser la madeixa de fil per a la confecció manual de mitjons?',
            'en' => "Did you know that the first product made from LIASA's cotton was the skein of yarn for the manual production of socks?",
            'fr' => "Saviez-vous que le premier produit fabriqué à partir du coton de LIASA a été l'écheveau de fil pour la production manuelle de chaussettes ?",
            'it' => 'Lo sapevate che il primo prodotto realizzato con il cotone LIASA è stata la matassa di filato per la produzione manuale di calze?',
        ];

        LanguageLine::create([
            'group' => 'Bloque100',
            'key' => 'seccion2_modal12_titulo',
            'text' => $textos
        ]);

        $textos = [
            'es' => 'Es lo que para entonces se conocía con el nombre de paquetería, un conjunto de madejas en paquetes de 25x50cm. ',
            'ca' => "És el que per a llavors es coneixia amb el nom de paqueteria, un conjunt de madeixes en paquets de 25x50cm.",
            'en' => 'This is what was known by then as a parcel service, a set of skeins in packages of 25x50cm. ',
            'fr' => "C'est ce qu'on appelait alors une boutique de colis, un ensemble d'écheveaux en paquets de 25x50cm. ",
            'it' => "Questo è quello che allora era conosciuto come un negozio di pacchi, un insieme di matasse in confezioni da 25x50cm. ",
        ];

        LanguageLine::create([
            'group' => 'Bloque100',
            'key' => 'seccion2_modal12_subtitulo',
            'text' => $textos
        ]);
    }
}