<?php

use App\Models\Language;
use Illuminate\Database\Seeder;
use Spatie\TranslationLoader\LanguageLine;

class TraductionsCompany extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $textos = [
            'es' => 'Contando contigo desde 1918',
            'ca' => 'Comptant amb tu des de 1918',
            'en' => 'Counting with you since 1918',
            'fr' => 'Comptant sur vous depuis 1918',
            'it' => 'Contando su di voi dal 1918',
        ];

        LanguageLine::create([
            'group' => 'Empresa',
            'key' => 'subtitulo',
            'text' => $textos
        ]);

        $textos = [
            'es' => 'Fabricación e innovación de cordones, cordones elásticos, cintas e hilo de polipropileno',
            'ca' => 'Fabricació i innovació en cordons, cordons elàstics, cintes i fil de polipropilè.',
            'en' => 'Manufacturing and innovation of cord, elastic cord, ribbon and polypropylene yarn',
            'fr' => 'Production et innovation de cordons, cordons élastiques, rubans et fil de polypropylène',
            'it' => 'Produzione e innovazione in cordoni, cordoni elastici, nastri e fili di polipropilene',
        ];

        LanguageLine::create([
            'group' => 'Empresa',
            'key' => 'seccion1_titulo',
            'text' => $textos
        ]);

        $textos = [
            'es' => 'Desde 1918, nuestro esfuerzo para evolucionar e innovar ha estado constando. Cuatro generaciones de la familia Cabré han convertido la empresa en un referente entre los principales fabricantes internacionales de cintas y cordones.',
            'ca' => 'Des de 1918, el nostre esforç per evolucionar i innovar ha estat constant. Quatre generacions de la família Cabré han esdevingut un referent entre els principals fabricants internacionals de cintes i cordons.',
            'en' => 'Our effort to develop and innovate has been continuous since 1918.
            Four Cabré generations have turned the company into a reference brand in ribbons and cords for international manufacturers.',
            'fr' => 'Depuis 1918, nos efforts pour évoluer et innover ont été constants. Quatre générations de la famille Cabré ont fait de la société une référence pour les principaux fabricants internationaux de rubans et cordons.',
            'it' => 'Dal 1918, il nostro sforzo per migliorare ed innovare è stato costante. Quattro generazioni della famiglia Cabré hanno trasformato la ditta in un punto di riferimento tra i principali produttori internazionali di nastri e cordoni.',
        ];

        LanguageLine::create([
            'group' => 'Empresa',
            'key' => 'seccion1_texto',
            'text' => $textos
        ]);

        $textos = [
            'es' => '· CONTIGO DESDE 1918 ·',
            'ca' => '· AMB TU DESDE 1918 ·',
            'en' => '· WITH YOU SINCE 1918 ·',
            'fr' => '· CHEZ VOUS DEPUIS 1918 ·',
            'it' => '· CON VOI DAL 1918 ·',
        ];

        LanguageLine::create([
            'group' => 'Empresa',
            'key' => 'seccion1_bloque100_titulo',
            'text' => $textos
        ]);

        $textos = [
            'es' => 'Ver más',
            'ca' => 'Veure més',
            'en' => 'See more',
            'fr' => 'En voir plus',
            'it' => 'Vedere di più',
        ];

        LanguageLine::create([
            'group' => 'Empresa',
            'key' => 'seccion1_bloque100_boton',
            'text' => $textos
        ]);

        $textos = [
            'es' => 'La fábrica',
            'ca' => 'La Fàbrica',
            'en' => 'Our factory',
            'fr' => 'L’usine',
            'it' => 'La Fabbrica',
        ];

        LanguageLine::create([
            'group' => 'Empresa',
            'key' => 'seccion2_titulo',
            'text' => $textos
        ]);

        $textos = [
            'es' => 'Nuestra fábrica de 15.000 m2 cuenta con más de 900 máquinas de última generación y está adaptada a los nuevos materiales y procesos de producción más innovadores. Contamos con un sistema de fabricación diseñado exclusivamente para nosotros; C.I.M. (Computer Integrated Manufacturing) para servir rápidamente los pedidos y evitar que nuestros clientes tengan stocks.',
            'ca' => 'La nostra fàbrica de 15.000 m2 té més de 900 màquines d’última generació, està adaptada a nous materials i als processos de producció més innovadors. Tenim un sistema de fabricació dissenyat exclusivament per a nosaltres, C.I.M. (Computer Integrated Manufacturing), per poder servir ràpidament les comandes i evitar que els nostres clients acumulin stock.',
            'en' => 'Our 15.000 m2 factory has more than 900 latest generation machines and it is adapted to new materials and innovative production processes. Our production software is exclusively developed for us; C.I.M. (Computer Integrated Manufacturing) so we can rapidly place and deliver orders as well as avoid stock needs for our customers.',
            'fr' => 'Notre usine de 15.000m2 compte plus de 900 machines de dernière génération, elle est adaptée pour les nouveaux matériaux et processus de fabrication plus innovants. Nous avons un système de fabrication exclusivement conçu pour nous ; C.I.M. ( Computer Integrated Manufacturing) pour livrer rapidement les commandes et éviter au maximum à nos clients d’avoir du stocks.',
            'it' => 'La nostra fabbrica di 15.000 m2 conta più di 900 macchine di ultima generazione ed è adattata ai nuovi materiali e ai processi di produzione più innovativi. Contiamo su un sistema di produzione disegnato esclusivamente per noi: il sistema C.I.M. (Computer Integrated Manufacturing) ci consente di poter evadere in modo rapido gli ordini ed evitare che ai nostri clienti vengano recapitati stocks.',
        ];


        LanguageLine::create([
            'group' => 'Empresa',
            'key' => 'seccion2_texto',
            'text' => $textos
        ]);

        $textos = [
            'es' => '¿Qué hacemos para ti?',
            'ca' => 'Què fem per a tu?',
            'en' => 'What do we do for you?',
            'fr' => 'Que faisons-nous pour vous ?',
            'it' => 'Cosa facciamo per te?',
        ];

        LanguageLine::create([
            'group' => 'Empresa',
            'key' => 'seccion3_titulo',
            'text' => $textos
        ]);

        $textos = [
            'es' => 'Las necesidades crecen y nos esforzamos día a día para evolucionar y dar el mejor de nosotros.',
            'ca' => 'Les necessitats creixen i ens esforcem dia a dia per a evolucionar i donar el millor de nosaltres.',
            'en' => 'Needs grow and we strive every day to evolve and give the best of us.',
            'fr' => "Les besoins grandissent et nous nous efforçons chaque jour d'évoluer et de donner le meilleur de nous-mêmes.",
            'it' => 'I bisogni crescono e ogni giorno ci sforziamo di evolvere e dare il meglio di noi.',
        ];

        LanguageLine::create([
            'group' => 'Empresa',
            'key' => 'seccion3_subtitulo',
            'text' => $textos
        ]);

        $textos = [
            'es' => 'Soluciones a medida',
            'ca' => 'Solucions a mida',
            'en' => 'Bespoke solutions',
            'fr' => 'Solutions sur mesure',
            'it' => 'Soluzioni su misura',
        ];

        LanguageLine::create([
            'group' => 'Empresa',
            'key' => 'seccion3_lista_titulo1',
            'text' => $textos
        ]);

        $textos = [
            'es' => 'Cada día hay nuevas necesidades. Nuestra misión es dar respuesta a cada una de ellas. Si algo no existe, lo creamos.',
            'ca' => "Cada dia hi ha noves necessitats. La nostra missió és donar resposta a cadascuna d'elles. Si alguna cosa no existeix, ho creguem.",
            'en' => 'Every day there are new needs. Our mission is to respond to each of them. If something does not exist, we create it.',
            'fr' => "Chaque jour, il y a de nouveaux besoins. Notre mission est de répondre à chacun d'eux. Si quelque chose n'existe pas, nous le créons.",
            'it' => "Ogni giorno ci sono nuove esigenze. La nostra missione è di rispondere a ciascuno di loro. Se qualcosa non esiste, noi lo creiamo.",
        ];

        LanguageLine::create([
            'group' => 'Empresa',
            'key' => 'seccion3_lista_texto1',
            'text' => $textos
        ]);

        $textos = [
            'es' => 'Ágiles',
            'ca' => 'Agils',
            'en' => 'Responsive',
            'fr' => 'Reactives',
            'it' => 'Agili',
        ];

        LanguageLine::create([
            'group' => 'Empresa',
            'key' => 'seccion3_lista_titulo2',
            'text' => $textos
        ]);

        $textos = [
            'es' => 'Contamos con un equipo de 70 personas altamente cualificadas y un extenso parque de máquinas que nos permite ser rápidos en el servicio al cliente, próximos y responder rápido a tus retos. Nuestros retos.',
            'ca' => 'Comptem amb un equip de 70 persones altament qualificades i amb un extens parc de màquines que ens permet ser ràpids en el servei al client, pròxims i agils en respondre als teus reptes. Els nostres reptes.',
            'en' => 'We have a highly qualified human team of 70 people and an extended machinery park which allows us to our customers’ requirements promptly. Our aim is to work closely with our clients and become a quick response to their challenges. Our challenges.',
            'fr' => 'Notre équipe de 70 personnes hautement qualifiées et notre grand parc de machines nous permet d’être réactives aux demandes de nos clients. Ces outils nous permettent de nous rapprocher et de répondre rapidement à vos défis qui sont les nôtres.',
            'it' => 'Contiamo su di un team di 70 persone altamente qualificate e su un esteso numero di macchine che ci permette di essere rapidi nel nostro servizio al cliente, vicini alle sue necessità e di rispondere velocemente alle sfide che ci proponete, che diventano le nostre sfide.',
        ];

        LanguageLine::create([
            'group' => 'Empresa',
            'key' => 'seccion3_lista_texto2',
            'text' => $textos
        ]);

        $textos = [
            'es' => 'Precisos',
            'ca' => 'Precisos',
            'en' => 'Precise',
            'fr' => 'Precision',
            'it' => 'Precisi',
        ];

        LanguageLine::create([
            'group' => 'Empresa',
            'key' => 'seccion3_lista_titulo3',
            'text' => $textos
        ]);

        $textos = [
            'es' => 'Desde la primera a la última aplicación de producto. Cualquiera de nuestras aplicaciones exige controles de calidad exhaustivos para garantizar precisión y eficacia.',
            'ca' => 'Des de la primera a l’última aplicació de producte. Qualsevol de les nostres aplicacions exigeix controls de qualitat exhaustius per garantir precisió i eficiència.',
            'en' => 'We are precise from the first to the last product application. Exhaustive quality controls are followed so we can guarantee precision and efficiency.',
            'fr' => 'Quelque soit la destination finale de notre produit. Toutes nos étapes de fabrication exigent des contrôles rigoureux de qualité pour garantir précision et efficacité.',
            'it' => 'Dalla prima all’ultima applicazione del prodotto. Qualunque nostra applicazione esige controlli di qualità esaustivi per garantire precisione ed efficacia.',
        ];

        LanguageLine::create([
            'group' => 'Empresa',
            'key' => 'seccion3_lista_texto3',
            'text' => $textos
        ]);

        $textos = [
            'es' => 'Líderes',
            'ca' => 'Líders',
            'en' => 'Leaders',
            'fr' => 'Leaders',
            'it' => 'Leader',
        ];

        LanguageLine::create([
            'group' => 'Empresa',
            'key' => 'seccion3_lista_titulo4',
            'text' => $textos
        ]);

        $textos = [
            'es' => 'Ser líderes europeos en determinados mercados nos obliga a ser más exigentes para seguir ofreciendo excelencia a nuestros clientes.',
            'ca' => 'El ser líders europeus en determinats mercats ens obliga a ser més exigents per seguir oferint excelència als nostres clients.',
            'en' => 'Being European leaders in different European markets makes work harder to be able to continue to offer excellence to our customers.',
            'fr' => 'Être les leaders Européens dans certains marchés nous oblige à être plus exigeants pour continuer à offrir l’excellence à nos clients.',
            'it' => 'Essere leader europei in determinati mercati ci obbliga ad essere sempre più esigenti per continuare ad offrire ai nostri clienti l’eccellenza del settore.',
        ];

        LanguageLine::create([
            'group' => 'Empresa',
            'key' => 'seccion3_lista_texto4',
            'text' => $textos
        ]);

        $textos = [
            'es' => 'Creativos',
            'ca' => 'Creatius',
            'en' => 'Creative',
            'fr' => 'Creativite',
            'it' => 'Creativi',
        ];

        LanguageLine::create([
            'group' => 'Empresa',
            'key' => 'seccion3_lista_titulo5',
            'text' => $textos
        ]);

        $textos = [
            'es' => 'La creatividad está presente en todos nuestros departamentos. Es el primer paso para adaptarse a los cambios que vivimos en todos los ámbitos.',
            'ca' => 'La creativitat està present a tots els nostres departaments. És el primer pas per adaptar-se als canvis que sorgeixen continuament a tots els àmbits.',
            'en' => 'Creativity is all over our departments. We take it as the first step for us to adapt to the changing world we live in.',
            'fr' => 'La créativité est présente dans tous nos départements. C’est le premier pas pour s’adapter aux changements du monde ou nous habitons.',
            'it' => 'La creatività è presente in tutti i nostri settori. È il primo passo per adattarsi ai cambiamenti che viviamo in ogni ambito.',
        ];

        LanguageLine::create([
            'group' => 'Empresa',
            'key' => 'seccion3_lista_texto5',
            'text' => $textos
        ]);

        $textos = [
            'es' => 'Innovadores',
            'ca' => 'Innovadors',
            'en' => 'Innovative',
            'fr' => 'Innovateurs',
            'it' => 'Innovatori',
        ];

        LanguageLine::create([
            'group' => 'Empresa',
            'key' => 'seccion3_lista_titulo6',
            'text' => $textos
        ]);

        $textos = [
            'es' => 'Innovar va mucho más allá que introducir tecnología disruptiva en nuestras fases de trabajo. Investigamos, hablamos y probamos para que las ideas tengan éxito en el mercado.',
            'ca' => 'Innovar va més enllà d’introduir tecnología disruptiva a totes les fases de treball. Investiguem, parlem i provem per a que les idees tinguin èxit en el mercat.',
            'en' => 'Innovating goes beyond introducing disruptive technology in our processes. We investigate, discuss and test so that any ideas are successful in the market.',
            'fr' => 'L’innovation va plus loin que l’introduction de technologie perturbante dans nos phases de travail. Nous recherchons, parlons et testons afin que les idées aient du succès sur le marché.',
            'it' => 'Innovare va molto oltre rispetto al fatto di introdurre tecnologia dirompente nelle nostri fasi di lavoro. Ricerchiamo, parliamo e testiamo per far sì che le idee abbiano successo sul mercato.',
        ];

        LanguageLine::create([
            'group' => 'Empresa',
            'key' => 'seccion3_lista_texto6',
            'text' => $textos
        ]);

        $textos = [
            'es' => 'Misión',
            'ca' => 'Missió',
            'en' => 'Mission',
            'fr' => 'Mission',
            'it' => 'La missione',
        ];


        LanguageLine::create([
            'group' => 'Empresa',
            'key' => 'seccion4_titulo',
            'text' => $textos
        ]);

        $textos = [
            'es' => 'Ofrecer',
            'ca' => 'Oferir',
            'en' => 'Offer',
            'fr' => 'Offre',
            'it' => 'Offerta',
        ];

        LanguageLine::create([
            'group' => 'Empresa',
            'key' => 'seccion4_lista_titulo1',
            'text' => $textos
        ]);

        $textos = [
            'es' => 'Ofrecer cordones, cintas y soluciones competitivas, diferenciadoras e innovadoras con el objetivo de superar las expectativas de los clientes, que permita lograr un nivel de resultados económicos y aseguren el proyecto a largo plazo.',
            'ca' => "Oferir cordons, cintes i solucions competitives, diferenciadores i innovadores amb l'objectiu de superar les expectatives dels clients, que permeti aconseguir un nivell de resultats econòmics i assegurin el projecte a llarg termini.",
            'en' => "To offer competitive, differentiating and innovative cords, tapes and solutions with the objective of exceeding customer expectations, which allows to achieve a level of economic results and ensure the project in the long term.",
            'fr' => "Offrir des cordons, rubans et solutions compétitifs, différenciants et innovants avec l'objectif de dépasser les attentes des clients, ce qui permet d'atteindre un niveau de résultats économiques et d'assurer le projet sur le long terme.",
            'it' => "Offrire cavi, nastri e soluzioni competitive, differenzianti e innovative con l'obiettivo di superare le aspettative del cliente, che permette di raggiungere un livello di risultati economici e garantire il progetto nel lungo termine.",
        ];

        LanguageLine::create([
            'group' => 'Empresa',
            'key' => 'seccion4_lista_texto1',
            'text' => $textos
        ]);

        $textos = [
            'es' => 'Practicar',
            'ca' => 'Practicar',
            'en' => 'Practice',
            'fr' => 'Pratique',
            'it' => 'Pratica',
        ];

        LanguageLine::create([
            'group' => 'Empresa',
            'key' => 'seccion4_lista_titulo2',
            'text' => $textos
        ]);


        $textos = [
            'es' => 'Practicar la escucha activa y la colaboración con los clientes actuales y potenciales para crear nuevos conceptos y soluciones que incorporen el conocimiento y los resultados de la pro actividad con proveedores innovadores y los centros tecnológicos, para estar en vanguardia.',
            'ca' => "Practicar l'escolta activa i la col·laboració amb els clients actuals i potencials per a crear nous conceptes i solucions que incorporin el coneixement i els resultats de la pro activitat amb proveïdors innovadors i els centres tecnològics, per a estar a l'avantguarda.",
            'en' => 'Practice active listening and collaboration with current and potential customers to create new concepts and solutions that incorporate the knowledge and results of pro-activity with innovative suppliers and technology centers, to be at the forefront.',
            'fr' => "Pratiquer l'écoute active et la collaboration avec les clients actuels et potentiels pour créer de nouveaux concepts et solutions qui intègrent la connaissance et les résultats de la pro-activité avec des fournisseurs innovants et des centres technologiques, pour être à l'avant-garde.",
            'it' => "Praticare l'ascolto attivo e la collaborazione con i clienti attuali e potenziali per creare nuovi concetti e soluzioni che incorporano le conoscenze e i risultati della proattività con fornitori e centri tecnologici innovativi, per essere all'avanguardia.",
        ];

        LanguageLine::create([
            'group' => 'Empresa',
            'key' => 'seccion4_lista_texto2',
            'text' => $textos
        ]);

        $textos = [
            'es' => 'Incorporar',
            'ca' => 'Incorporar',
            'en' => 'Incorporate',
            'fr' => 'Incorporer',
            'it' => 'Incorporare',
        ];

        LanguageLine::create([
            'group' => 'Empresa',
            'key' => 'seccion4_lista_titulo3',
            'text' => $textos
        ]);

        $textos = [
            'es' => ' Incorporar los valores de gestión que permitan al equipo humano de la empresa su crecimiento profesional y personal para reforzar nuestro compromiso con la sostenibilidad y sociedad de nuestro entorno.',
            'ca' => "Incorporar els valors de gestió que permetin a l'equip humà de l'empresa el seu creixement professional i personal per a reforçar el nostre compromís amb la sostenibilitat i societat del nostre entorn.",
            'en' => "To incorporate the management values that allow the company's human team to grow professionally and personally in order to reinforce our commitment to the sustainability and society of our environment.",
            'fr' => "Intégrer les valeurs de gestion qui permettent à l'équipe humaine de l'entreprise de se développer professionnellement et personnellement afin de renforcer notre engagement envers la durabilité et la société de notre environnement.",
            'it' => "Integrare i valori gestionali che permettono al team umano dell'azienda di crescere professionalmente e personalmente per rafforzare il nostro impegno per la sostenibilità e la società del nostro ambiente.",
        ];

        LanguageLine::create([
            'group' => 'Empresa',
            'key' => 'seccion4_lista_texto3',
            'text' => $textos
        ]);
    }
}
