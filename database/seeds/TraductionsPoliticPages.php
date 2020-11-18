<?php

use Illuminate\Database\Seeder;
use Spatie\TranslationLoader\LanguageLine;

class TraductionsPoliticPages extends Seeder
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
            'group' => 'Politicas',
            'key' => 'titulo_aviso_legal',
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
            'group' => 'Politicas',
            'key' => 'titulo_politica_privacidad',
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
            'group' => 'Politicas',
            'key' => 'titulo_politica_cookies',
            'text' => $textos
        ]);

        $textos = [
            'es' => '<p><strong>POLÍTICA DE COOKIES</strong></p>
            <p>Esta página web usa cookies para mejorar la experiencia del usuario. A continuación, encontrará información sobre qué son las cookies, qué tipo de cookies utiliza esta página, cómo puede desactivar las cookies en su navegador y cómo desactivar específicamente la instalación de cookies de terceros. Si no encuentra la información específica que usted está buscando, por favor envíe un correo a comercial@laindustrialalgodonera.com</p>
            <p><strong>¿Qué son las cookies?</strong><br>
            Las cookies son pequeños archivos que algunas plataformas, como las páginas web, pueden instalar en su ordenador, smartphone, tableta o televisión conectada. Sus funciones pueden ser muy variadas: almacenar sus preferencias de navegación, recopilar información estadística, permitir ciertas funcionalidades técnicas, etc.</p>
            <p><strong>¿Por qué las utilizamos?</strong><br>
            Las cookies son útiles por varios motivos. Desde un punto de vista técnico, permiten que las páginas web funcionen de forma más ágil y adaptada a sus preferencias, como por ejemplo almacenar su idioma o la moneda de su país. Además, ayudan a los responsables de los sitios web a mejorar los servicios que ofrecen, gracias a la información estadística que recogen a través de ellas y sirven para hacer más eficiente la publicidad que le podemos mostrar.</p>
            <p><strong>¿Qué uso le damos a los diferentes tipos de cookies?</strong><br>
            Cookies de sesión: Las cookies de sesión son aquellas que duran el tiempo que el usuario está navegando por la página web y se borran al término.<br>
            Cookies persistentes: Estas cookies quedan almacenadas en el terminal del usuario por un tiempo más largo, facilitando así el control de las preferencias elegidas sin tener que repetir ciertos parámetros cada vez que se visite el sitio web.<br>
            Cookies propias: Son cookies creadas por este sitio web y que solo puede leer el propio sitio. Por ejemplo: cookies técnicas para la carga de imágenes, cookies de personalización de parámetros de la web, cookies de análisis de tráfico, etc.<br>
            Cookies de terceros: Son cookies creadas por terceros y que utilizamos para diferentes servicios (por ej. Análisis del sitio web o publicidad).</p>
            <p><strong>Según su finalidad:</strong><br>
            Cookies técnicas: Las cookies técnicas son aquellas imprescindibles y estrictamente necesarias para el correcto funcionamiento de un portal Web y la utilización de las diferentes opciones y servicios que ofrece. Por ejemplo, las que sirven para el mantenimiento de la sesión, la gestión del tiempo de respuesta, rendimiento o validación de opciones, utilizar elementos de seguridad, compartir contenido con redes sociales, etc.<br>
            Cookies de personalización: Estas cookies permiten al usuario especificar o personalizar algunas características de las opciones generales de la página Web. Por ejemplo, definir el idioma, configuración regional o tipo de navegador.<br>
            Cookies analíticas: Las cookies analíticas son las utilizadas por nuestro portal Web, para elaborar perfiles de navegación y poder conocer las preferencias de los usuarios del mismo con el fin de mejorar la oferta de productos y servicios. Por ejemplo, mediante una cookie analítica se controlarían las áreas geográficas de mayor interés de un usuario, cuál es el producto de más aceptación, etc.<br>
            Cookies publicitarias: Las cookies publicitarias permiten la gestión de los espacios publicitarios en base a criterios concretos. Por ejemplo la frecuencia de acceso, el contenido editado, etc. Las cookies de publicidad permiten a través de la gestión de la publicidad almacenar información del comportamiento a través de la observación de hábitos, estudiando los accesos y formando un perfil de preferencias del usuario, para ofrecerle publicidad relacionada con los intereses de su perfil.</p>
            <p><strong>¿Qué cookies utilizamos?</strong></p>
            <table width="0">
            <tbody>
            <tr>
            <td width="180">&nbsp;COOKIE</td>
            <td width="402">&nbsp;FINALIDAD</td>
            <td width="85">&nbsp;TERCERO</td>
            <td width="102">&nbsp;DURACIÓN</td>
            </tr>
            <tr>
            <td width="180">&nbsp;_ga</td>
            <td width="402">&nbsp;Google Analytics</td>
            <td width="85">Si</td>
            <td width="102">48 h</td>
            </tr>
            <tr>
            <td width="180">_gid</td>
            <td width="402">Google Analytics</td>
            <td width="85">Si</td>
            <td width="102">48 h</td>
            </tr>
            <tr>
            <td width="180">laravel_session</td>
            <td width="402">Usado para el funcionameiento básico de la web</td>
            <td width="85">No</td>
            <td width="102">Final de sesión</td>
            </tr>
            <tr>
            <td width="180">XSRF-TOKEN</td>
            <td width="402">Usado para el funcionameiento básico de la web</td>
            <td width="85">No</td>
            <td width="102">Final de sesión</td>
            </tr>
            <tr>
            <td width="180">cookieconsent_status</td>
            <td width="402">Comprobar que se han aceptado las cookies</td>
            <td width="85">No</td>
            <td width="102">1 año</td>
            </tr>
            </tbody>
            </table>
            <p><strong>¿Cómo puedo cambiar la configuración de las cookies?</strong></p>
            <p>Configuración de cookies de Internet Explorer<br>
            Configuración de cookies de Firefox<br>
            Configuración de cookies de Google Chrome<br>
            Configuración de cookies de Safari<br>
            Configuración de cookies Flash</p>
            <p>Estos navegadores están sometidos a actualizaciones o modificaciones, por lo que no podemos garantizar que se ajusten completamente a la versión de su navegador. También puede ser que utilice otro navegador no contemplado en estos enlaces como Konqueror, Arora, Flock, etc. Para evitar estos desajustes, puede acceder directamente desde las opciones de su navegador, generalmente en el menú de «Opciones» en la sección de «Privacidad». (Por favor, consulte la ayuda de su navegador para más información).</p>',
            'ca' => '<p><strong>POLÍTICA DE COOKIES</strong></p>
            <p>Aquesta pàgina web utilitza cookies per a millorar l’experiència de l’usuari. A continuació, trobarà informació sobre que són les cookies, quin tipus de cookies utilitza aquesta pàgina, com pot desactivar les cookies en el seu navegador i com desactivar específicament la instal·lació de cookies de tercers. Si no troba la informació específica que està buscant, si us plau enviï un correu a comercial@laindustrialalgodonera.com.</p>
            <p><strong>Què són les cookies?</strong></p>
            <p>Les cookies són útils per diversos motius. Des d’un punt de vista tècnic, permeten que les pàgines web funcionin de forma més àgil i adaptada a les seves preferències, com per exemple emmagatzemar el seu idioma o la moneda del seu país. A més, ajuden als responsables dels llocs web a millorar els serveis que ofereixen, gràcies a la informació estadística que recullen a través d’elles i serveixen per fer més eficient la publicitat que li podem mostrar.</p>
            <p><strong>Quin ús li donem als diferents tipus de cookies?</strong></p>
            <p><strong>Cookies de sessió:</strong> Les cookies de sessió són aquelles que duren el temps que l’usuari està navegant per la pàgina web i s’esborren al finalitzar.</p>
            <p><strong>Cookies persistents:</strong> Aquestes cookies queden emmagatzemades al terminal de l’usuari, per un temps més llarg, facilitant així el control de les preferències escollides sense haver de repetir certs paràmetres cada vegada que es visiti el lloc web.</p>
            <p><strong>Cookies pròpies:</strong> Són cookies creades pel lloc web i que només pot llegir la pròpia pàgina. Per exemple: cookies tècniques per la càrrega d’imatges, cookies de personalització de paràmetres de la web, cookies d’anàlisis de tràfic, etc.</p>
            <p><strong>Cookies de tercers:</strong> Són cookies creades per tercers i que utilitzem per diferents serveis (per ex. Anàlisis del lloc web o publicitat).</p>
            <p>Segons la seva finalitat:</p>
            <p><strong>Cookies tècniques:</strong> Les cookies tècniques són aquelles imprescindibles i estrictament necessàries per al correcte funcionament d’un portal web i la utilització de les diferents opcions i serveis que ofereix. Per exemple, les que serveixen per al manteniment de la sessió, la gestió del temps de resposta, rendiment o validació d’opcions, utilitzar elements de seguretat, compartir contingut en xarxes socials, etc.</p>
            <p><strong>Cookies de personalització:</strong> Aquestes cookies permeten a l’usuari especificar o personalitzar algunes característiques de les opcions generals de la pàgina web, per exemple, definir l’idioma, configuració regional o tipus de navegador.</p>
            <p><strong>Cookies analítiques:</strong> Les cookies analítiques són les utilitzades pel nostre portal web, per elaborar perfils de navegació i poder conèixer les preferències dels usuaris del mateix per tal de millorar l’oferta de productes i serveis. Per exemple, mitjançant una cookie analítica es controlarien les àrees geogràfiques de major interès d’un usuari, quin és el producte de més acceptació, etc.</p>
            <p><strong>Cookies publicitàries:</strong> Les cookies publicitàries permeten la gestió dels espais publicitaris en base a criteris concrets. Per exemple la freqüència d’accés, el contingut editat, etc. Les cookies de publicitat permeten a través de la gestió de la publicitat emmagatzemar informació del comportament a través de l’observació d’hàbits, estudiant els accessos i formant un perfil de preferències de l’usuari, per oferir publicitat relacionada amb els interessos del seu perfil.</p>
            <p>&nbsp;</p>
            <p><strong>Quines cookies utilitzem en el nostre lloc web?</strong></p>
            <p>A continuació, es detallen les cookies utilitzades en aquesta pàgina web i si són pròpies o d’un tercer.</p>
            <table width="0">
            <tbody>
            <tr>
            <td width="180">&nbsp;COOKIE</td>
            <td width="402">&nbsp;FINALITAT</td>
            <td width="85">&nbsp;TERCERS</td>
            <td width="102">&nbsp;DURADA</td>
            </tr>
            <tr>
            <td width="180">&nbsp;_ga</td>
            <td width="402">&nbsp;Google Analytics</td>
            <td width="85">Si</td>
            <td width="102">48 h</td>
            </tr>
            <tr>
            <td width="180">_gid</td>
            <td width="402">Google Analytics</td>
            <td width="85">Si</td>
            <td width="102">48 h</td>
            </tr>
            <tr>
            <td width="180">laravel_session</td>
            <td width="402">Usat per al funcionameiento bàsic de la web</td>
            <td width="85">No</td>
            <td width="102">Final de sessió</td>
            </tr>
            <tr>
            <td width="180">XSRF-TOKEN</td>
            <td width="402">Usat per al funcionameiento bàsic de la web</td>
            <td width="85">No</td>
            <td width="102">Final de sessió</td>
            </tr>
            <tr>
            <td width="180">cookieconsent_status</td>
            <td width="402">Comprovar que s\'han acceptat les cookies</td>
            <td width="85">No</td>
            <td width="102">1 any</td>
            </tr>
            </tbody>
            </table>
            <p>&nbsp;</p>
            <p><strong>&nbsp;</strong><strong>Com puc canviar la configuració de les cookies?</strong></p>
            <p><a href="http://windows.microsoft.com/es-es/windows-vista/block-or-allow-cookies">Configuració de cookies de Internet Explorer</a></p>
            <p><a href="http://support.mozilla.org/es/kb/habilitar-y-deshabilitar-cookies-que-los-sitios-we">Configuració de cookies de Firefox</a></p>
            <p><a href="https://support.google.com/chrome/answer/95647?hl=es">Configuració de cookies de Google Chrome</a></p>
            <p><a href="http://support.apple.com/kb/HT1677?viewlocale=es_ES&amp;locale=es_ES">Configuració de cookies de Safari</a></p>
            <p><a href="http://www.macromedia.com/support/documentation/es/flashplayer/help/settings_manager03.html">Configuració de cookies Flash</a></p>
            <p>&nbsp;</p>
            <p>Aquests navegadors estan sotmesos a actualitzacions o modificacions, pel que no podem garantir que s’ajustin completament a la versió del seu navegador. També pot ser que utilitzi un altre navegador no contemplat en aquests enllaços com Konqueror, Aora, Flock, etc. Per a evitar aquests desajustaments, pot accedir directament des de les opcions del seu navegador, generalment en el menú d’ “Opcions” a la secció de “Privacitat”. (Si us plau, consulti l’ajuda del seu navegador per a més informació).</p>',
            'en' => '<p><strong>COOKIE POLICY</strong></p>
            <p><strong>What is a cookie?</strong></p>
            <p>Cookies are usually small text files stored at the terminal from the web site visited and are used to register certain interactions of navigation in a Web site by storing data that may be updated and retrieved. These files are stored on the user’s computer and contain anonymous data that are not harmful to your computer equipment.</p>
            <p>They are used to remember user preferences, such as the selected language, access data or customization of the page. Cookies may also be used to record anonymous information about how a visitor uses a site. For example, from which Web page you accessed, or if you used an advertising “banner” to get there.</p>
            <p><strong>&nbsp;</strong></p>
            <p><strong>Why do we use cookies?</strong></p>
            <p>LA INDUSTRIAL ALGODONERA, SA uses cookies being strictly necessary and essential for you to use our Web sites and allow you to move freely, use safe areas, customized options, etc. In addition, LA INDUSTRIAL ALGODONERA, SA uses cookies that collect data relating to the analysis of the Web usage. These are used to help to improve the customer service, by measuring the use and performance of the page, to optimize and customize it. Our sites may also have links to social networks (like Facebook or Twitter). LA INDUSTRIAL ALGODONERA, SA does not control the cookies used by these external Websites. For further information on cookies related to social networks or other external Websites, please review their own cookie policies.</p>
            <p>&nbsp;</p>
            <p><strong>Which use do we give to different types of cookie?</strong></p>
            <p><strong>Session Cookies:</strong> Session cookies are those that last as long as the user is browsing the website and are deleted at the end.</p>
            <p><strong>Persistent Cookies:</strong> These cookies are stored in the user terminal for a longer time, thus facilitating control of the preferences chosen without having to repeat certain parameters each time you visit the website.</p>
            <p><strong>Own cookies:</strong> These are cookies created by this website and that only can be read by the site itself. For example: Technical cookies for uploading images, cookies for customization of parameters of the web, cookies for traffic analysis, etc.</p>
            <p><strong>Third Party Cookies:</strong> These are cookies created by third parties that we use for different services (eg analysis of the website or advertising.)</p>
            <p>According to their purpose:</p>
            <p><strong>Technical cookies:</strong> Technical cookies are those essential and strictly necessary for the proper running of a Web portal and the use of the different options and services offered. For example, those serving for maintenance of the session, management of response time, performance or validation of options, use of security elements, sharing content with social networks, etc.</p>
            <p><strong>Cookies for customization:</strong> These cookies allow the user to specify or customize some features of the general settings of the Web page. For example, setting the language, local setting or type of browser.</p>
            <p><strong>Analytical Cookies:</strong> Analytical cookies are used by our web portal, &nbsp;to develop profiles of navigation, and to know the preferences of users thereof in order to improve the supply of products and services. For example, by using an analytical cookie the geographical areas of major interest for a user would be controlled, which is the product of more acceptance, etc.</p>
            <p><strong>Advertising Cookies:</strong> Advertising cookies allow management of advertising spaces based on specific criteria. For example, the frequency of access, the edited content, etc. These cookies allow through advertising management to store information on behaviour by observing habits, studying the access and forming a profile of user preferences, in order to provide advertising related to the interests of user’s profile.</p>
            <p>&nbsp;</p>
            <p><strong>Which cookies do we use on our website?</strong></p>
             <table width="0">
            <tbody>
            <tr>
            <td width="180">&nbsp;COOKIE</td>
            <td width="402">&nbsp;PURPOSE</td>
            <td width="85">&nbsp;THIRD</td>
            <td width="102">&nbsp;DURATION</td>
            </tr>
            <tr>
            <td width="180">&nbsp;_ga</td>
            <td width="402">&nbsp;Google Analytics</td>
            <td width="85">Si</td>
            <td width="102">48 h</td>
            </tr>
            <tr>
            <td width="180">_gid</td>
            <td width="402">Google Analytics</td>
            <td width="85">Si</td>
            <td width="102">48 h</td>
            </tr>
            <tr>
            <td width="180">laravel_session</td>
            <td width="402">Used for the basic operation of the web</td>
            <td width="85">No</td>
            <td width="102">End of session</td>
            </tr>
            <tr>
            <td width="180">XSRF-TOKEN</td>
            <td width="402">Used for the basic operation of the web</td>
            <td width="85">No</td>
            <td width="102">End of session</td>
            </tr>
            <tr>
            <td width="180">cookieconsent_status</td>
            <td width="402">Verify that cookies have been accepted</td>
            <td width="85">No</td>
            <td width="102">1 year</td>
            </tr>
            </tbody>
            </table>
            <p>&nbsp;</p>
            <p><strong>How can I change the cookie settings?</strong></p>
            <p><a href="http://windows.microsoft.com/es-es/windows-vista/block-or-allow-cookies">Internet Explorer cookie settings</a></p>
            <p><a href="http://support.mozilla.org/es/kb/habilitar-y-deshabilitar-cookies-que-los-sitios-we">Firefox cookie settings</a></p>
            <p><a href="https://support.google.com/chrome/answer/95647?hl=es">Google cookie settings Chrome</a></p>
            <p><a href="http://support.apple.com/kb/HT1677?viewlocale=es_ES&amp;locale=es_ES">Safari cookie settings</a></p>
            <p><a href="http://www.macromedia.com/support/documentation/es/flashplayer/help/settings_manager03.html">Flash cookie settings</a></p>
            <p>&nbsp;</p>
            <p>These browsers are submitted to upgrades or modifications, so we cannot guarantee that fully fit the version of your browser. You might also use another browser that is not referred to in these links such as Konqueror, Arora, Flock, etc. To avoid these imbalances, you may have access directly from your browser options, which is usually found in the Options menu, in the section “Privacy”. (Please refer to your browser help for further information.)</p>',
            'fr' => '<p><strong>COOKIE POLICY</strong></p>
            <p><strong>What is a cookie?</strong></p>
            <p>Cookies are usually small text files stored at the terminal from the web site visited and are used to register certain interactions of navigation in a Web site by storing data that may be updated and retrieved. These files are stored on the user’s computer and contain anonymous data that are not harmful to your computer equipment.</p>
            <p>They are used to remember user preferences, such as the selected language, access data or customization of the page. Cookies may also be used to record anonymous information about how a visitor uses a site. For example, from which Web page you accessed, or if you used an advertising “banner” to get there.</p>
            <p><strong>&nbsp;</strong></p>
            <p><strong>Why do we use cookies?</strong></p>
            <p>LA INDUSTRIAL ALGODONERA, SA uses cookies being strictly necessary and essential for you to use our Web sites and allow you to move freely, use safe areas, customized options, etc. In addition, LA INDUSTRIAL ALGODONERA, SA uses cookies that collect data relating to the analysis of the Web usage. These are used to help to improve the customer service, by measuring the use and performance of the page, to optimize and customize it. Our sites may also have links to social networks (like Facebook or Twitter). LA INDUSTRIAL ALGODONERA, SA does not control the cookies used by these external Websites. For further information on cookies related to social networks or other external Websites, please review their own cookie policies.</p>
            <p>&nbsp;</p>
            <p><strong>Which use do we give to different types of cookie?</strong></p>
            <p><strong>Session Cookies:</strong> Session cookies are those that last as long as the user is browsing the website and are deleted at the end.</p>
            <p><strong>Persistent Cookies:</strong> These cookies are stored in the user terminal for a longer time, thus facilitating control of the preferences chosen without having to repeat certain parameters each time you visit the website.</p>
            <p><strong>Own cookies:</strong> These are cookies created by this website and that only can be read by the site itself. For example: Technical cookies for uploading images, cookies for customization of parameters of the web, cookies for traffic analysis, etc.</p>
            <p><strong>Third Party Cookies:</strong> These are cookies created by third parties that we use for different services (eg analysis of the website or advertising.)</p>
            <p>According to their purpose:</p>
            <p><strong>Technical cookies:</strong> Technical cookies are those essential and strictly necessary for the proper running of a Web portal and the use of the different options and services offered. For example, those serving for maintenance of the session, management of response time, performance or validation of options, use of security elements, sharing content with social networks, etc.</p>
            <p><strong>Cookies for customization:</strong> These cookies allow the user to specify or customize some features of the general settings of the Web page. For example, setting the language, local setting or type of browser.</p>
            <p><strong>Analytical Cookies:</strong> Analytical cookies are used by our web portal, &nbsp;to develop profiles of navigation, and to know the preferences of users thereof in order to improve the supply of products and services. For example, by using an analytical cookie the geographical areas of major interest for a user would be controlled, which is the product of more acceptance, etc.</p>
            <p><strong>Advertising Cookies:</strong> Advertising cookies allow management of advertising spaces based on specific criteria. For example, the frequency of access, the edited content, etc. These cookies allow through advertising management to store information on behaviour by observing habits, studying the access and forming a profile of user preferences, in order to provide advertising related to the interests of user’s profile.</p>
            <p>&nbsp;</p>
            <p><strong>Which cookies do we use on our website?</strong></p>
             <table width="0">
            <tbody>
            <tr>
            <td width="180">&nbsp;COOKIE</td>
            <td width="402">&nbsp;PURPOSE</td>
            <td width="85">&nbsp;THIRD</td>
            <td width="102">&nbsp;DURATION</td>
            </tr>
            <tr>
            <td width="180">&nbsp;_ga</td>
            <td width="402">&nbsp;Google Analytics</td>
            <td width="85">Si</td>
            <td width="102">48 h</td>
            </tr>
            <tr>
            <td width="180">_gid</td>
            <td width="402">Google Analytics</td>
            <td width="85">Si</td>
            <td width="102">48 h</td>
            </tr>
            <tr>
            <td width="180">laravel_session</td>
            <td width="402">Used for the basic operation of the web</td>
            <td width="85">No</td>
            <td width="102">End of session</td>
            </tr>
            <tr>
            <td width="180">XSRF-TOKEN</td>
            <td width="402">Used for the basic operation of the web</td>
            <td width="85">No</td>
            <td width="102">End of session</td>
            </tr>
            <tr>
            <td width="180">cookieconsent_status</td>
            <td width="402">Verify that cookies have been accepted</td>
            <td width="85">No</td>
            <td width="102">1 year</td>
            </tr>
            </tbody>
            </table>
            <p>&nbsp;</p>
            <p><strong>How can I change the cookie settings?</strong></p>
            <p><a href="http://windows.microsoft.com/es-es/windows-vista/block-or-allow-cookies">Internet Explorer cookie settings</a></p>
            <p><a href="http://support.mozilla.org/es/kb/habilitar-y-deshabilitar-cookies-que-los-sitios-we">Firefox cookie settings</a></p>
            <p><a href="https://support.google.com/chrome/answer/95647?hl=es">Google cookie settings Chrome</a></p>
            <p><a href="http://support.apple.com/kb/HT1677?viewlocale=es_ES&amp;locale=es_ES">Safari cookie settings</a></p>
            <p><a href="http://www.macromedia.com/support/documentation/es/flashplayer/help/settings_manager03.html">Flash cookie settings</a></p>
            <p>&nbsp;</p>
            <p>These browsers are submitted to upgrades or modifications, so we cannot guarantee that fully fit the version of your browser. You might also use another browser that is not referred to in these links such as Konqueror, Arora, Flock, etc. To avoid these imbalances, you may have access directly from your browser options, which is usually found in the Options menu, in the section “Privacy”. (Please refer to your browser help for further information.)</p>',
            'it' => '<p><strong>COOKIE POLICY</strong></p>
            <p><strong>What is a cookie?</strong></p>
            <p>Cookies are usually small text files stored at the terminal from the web site visited and are used to register certain interactions of navigation in a Web site by storing data that may be updated and retrieved. These files are stored on the user’s computer and contain anonymous data that are not harmful to your computer equipment.</p>
            <p>They are used to remember user preferences, such as the selected language, access data or customization of the page. Cookies may also be used to record anonymous information about how a visitor uses a site. For example, from which Web page you accessed, or if you used an advertising “banner” to get there.</p>
            <p><strong>&nbsp;</strong></p>
            <p><strong>Why do we use cookies?</strong></p>
            <p>LA INDUSTRIAL ALGODONERA, SA uses cookies being strictly necessary and essential for you to use our Web sites and allow you to move freely, use safe areas, customized options, etc. In addition, LA INDUSTRIAL ALGODONERA, SA uses cookies that collect data relating to the analysis of the Web usage. These are used to help to improve the customer service, by measuring the use and performance of the page, to optimize and customize it. Our sites may also have links to social networks (like Facebook or Twitter). LA INDUSTRIAL ALGODONERA, SA does not control the cookies used by these external Websites. For further information on cookies related to social networks or other external Websites, please review their own cookie policies.</p>
            <p>&nbsp;</p>
            <p><strong>Which use do we give to different types of cookie?</strong></p>
            <p><strong>Session Cookies:</strong> Session cookies are those that last as long as the user is browsing the website and are deleted at the end.</p>
            <p><strong>Persistent Cookies:</strong> These cookies are stored in the user terminal for a longer time, thus facilitating control of the preferences chosen without having to repeat certain parameters each time you visit the website.</p>
            <p><strong>Own cookies:</strong> These are cookies created by this website and that only can be read by the site itself. For example: Technical cookies for uploading images, cookies for customization of parameters of the web, cookies for traffic analysis, etc.</p>
            <p><strong>Third Party Cookies:</strong> These are cookies created by third parties that we use for different services (eg analysis of the website or advertising.)</p>
            <p>According to their purpose:</p>
            <p><strong>Technical cookies:</strong> Technical cookies are those essential and strictly necessary for the proper running of a Web portal and the use of the different options and services offered. For example, those serving for maintenance of the session, management of response time, performance or validation of options, use of security elements, sharing content with social networks, etc.</p>
            <p><strong>Cookies for customization:</strong> These cookies allow the user to specify or customize some features of the general settings of the Web page. For example, setting the language, local setting or type of browser.</p>
            <p><strong>Analytical Cookies:</strong> Analytical cookies are used by our web portal, &nbsp;to develop profiles of navigation, and to know the preferences of users thereof in order to improve the supply of products and services. For example, by using an analytical cookie the geographical areas of major interest for a user would be controlled, which is the product of more acceptance, etc.</p>
            <p><strong>Advertising Cookies:</strong> Advertising cookies allow management of advertising spaces based on specific criteria. For example, the frequency of access, the edited content, etc. These cookies allow through advertising management to store information on behaviour by observing habits, studying the access and forming a profile of user preferences, in order to provide advertising related to the interests of user’s profile.</p>
            <p>&nbsp;</p>
            <p><strong>Which cookies do we use on our website?</strong></p>
             <table width="0">
            <tbody>
            <tr>
            <td width="180">&nbsp;COOKIE</td>
            <td width="402">&nbsp;PURPOSE</td>
            <td width="85">&nbsp;THIRD</td>
            <td width="102">&nbsp;DURATION</td>
            </tr>
            <tr>
            <td width="180">&nbsp;_ga</td>
            <td width="402">&nbsp;Google Analytics</td>
            <td width="85">Si</td>
            <td width="102">48 h</td>
            </tr>
            <tr>
            <td width="180">_gid</td>
            <td width="402">Google Analytics</td>
            <td width="85">Si</td>
            <td width="102">48 h</td>
            </tr>
            <tr>
            <td width="180">laravel_session</td>
            <td width="402">Used for the basic operation of the web</td>
            <td width="85">No</td>
            <td width="102">End of session</td>
            </tr>
            <tr>
            <td width="180">XSRF-TOKEN</td>
            <td width="402">Used for the basic operation of the web</td>
            <td width="85">No</td>
            <td width="102">End of session</td>
            </tr>
            <tr>
            <td width="180">cookieconsent_status</td>
            <td width="402">Verify that cookies have been accepted</td>
            <td width="85">No</td>
            <td width="102">1 year</td>
            </tr>
            </tbody>
            </table>
            <p>&nbsp;</p>
            <p><strong>How can I change the cookie settings?</strong></p>
            <p><a href="http://windows.microsoft.com/es-es/windows-vista/block-or-allow-cookies">Internet Explorer cookie settings</a></p>
            <p><a href="http://support.mozilla.org/es/kb/habilitar-y-deshabilitar-cookies-que-los-sitios-we">Firefox cookie settings</a></p>
            <p><a href="https://support.google.com/chrome/answer/95647?hl=es">Google cookie settings Chrome</a></p>
            <p><a href="http://support.apple.com/kb/HT1677?viewlocale=es_ES&amp;locale=es_ES">Safari cookie settings</a></p>
            <p><a href="http://www.macromedia.com/support/documentation/es/flashplayer/help/settings_manager03.html">Flash cookie settings</a></p>
            <p>&nbsp;</p>
            <p>These browsers are submitted to upgrades or modifications, so we cannot guarantee that fully fit the version of your browser. You might also use another browser that is not referred to in these links such as Konqueror, Arora, Flock, etc. To avoid these imbalances, you may have access directly from your browser options, which is usually found in the Options menu, in the section “Privacy”. (Please refer to your browser help for further information.)</p>',
        ];

        LanguageLine::create([
            'group' => 'Politicas',
            'key' => 'texto_politica_cookies',
            'text' => $textos
        ]);

        $textos = [
            'es' => '<p><strong>LA INDUSTRIAL ALGODONERA, S.A.</strong>, como responsable del presente Sitio Web y en conformidad con lo que dispone la normativa vigente en materia de protección de datos personales, el Reglamento (UE) 2016/679 de 27 de abril de 2016 (RGPD) relativo a la protección de las personas físicas en cuanto al tratamiento de datos personales y a la libre circulación de estos datos, la Ley Orgánica 15/1999, de 13 de diciembre, de Protección de Datos de Carácter Personal (LOPD) y por la Ley 34/2002, de 11 de julio, de Servicios de la Sociedad de la Información y del Comercio Electrónico (LSSICE), tiene implementadas todas las medidas de seguridad, de índole técnica y organizativas, establecidas en el Real decreto 1720/2007 de 21 de Diciembre, (que desarrolla la LOPD) para garantizar y proteger la confidencialidad, integridad y disponibilidad de los datos introducidos.</p>
            <p>A efectos de lo que prevé la LOPD, <a href="https://www.laindustrialalgodonera.com/">LA INDUSTRIAL ALGODONERA, S.A.</a> le informa que los datos que voluntariamente nos está facilitando serán incorporados a nuestros sistemas de información con el fin de realizar las gestiones comerciales y administrativas necesarias con los usuarios de la web. Las operaciones previstas para realizar los tratamientos son los siguientes: responder a las consultas y/o proporcionar las informaciones requeridas por el Usuario; realizar las prestaciones de servicios y/o productos contratados o suscritos por el Usuario; realizar todas aquellas actividades propias de LA INDUSTRIAL ALGODONERA, S.A. reseñadas por el presente Aviso Legal, y remitir el boletín de noticias de la página web.</p>
            <p>El firmante garantiza la veracidad de los datos aportados y se compromete a comunicar cualquier cambio que se produzca en los mismos.</p>
            <p>El Prestador, mediante asterisco (*) en las casillas correspondientes del formulario de contacto, le informa de esta obligatoriedad al Usuario, indicando qué datos son necesarios. Mediante la indicación e introducción de los datos, el Usuario otorga el consentimiento inequívoco a LA INDUSTRIAL ALGODONERA, S.A. para que proceda al tratamiento de los datos facilitados en pro de las finalidades mencionadas.</p>
            <p>El no facilitar los datos personales solicitados o el no aceptar la presente política de protección de datos supone la imposibilidad de subscribirse, registrarse o recibir información de los productos y servicios del prestador.</p>
            <p>En conformidad con lo que disponen las normativas vigentes en protección de datos personales, el prestador está cumpliendo con todas las disposiciones de las normativas RGPD y LOPD para el tratamiento de los datos personales de su responsabilidad, y manifiestamente con los principios descritos en el art. 5 del RGPD y en el art. 4 de la LOPD, por los cuales son tratados de manera lícita, leal y transparente en relación con el interesado y adecuadas, pertinentes y limitados al que es necesario en relación a los fines para los cuales son tratados.</p>
            <p>El Responsable garantiza que ha implementado políticas técnicas y organizativas apropiadas para aplicar las medidas de seguridad que establecen el RGPD y la LOPD para proteger los derechos y libertades de los Usuarios.<br>
            De acuerdo con estas normativas, pues, le informamos que tiene derecho a solicitar el acceso, rectificación, portabilidad y supresión de sus datos y la limitación y oposición a su tratamiento dirigiéndose a <a href="mailto:marketing@laindustrialalgodonera.com">marketing@laindustrialalgodonera.com</a> o mediante una carta a C/Sant Rafael Nº 21 (CP.43470) de la Selva del Camp, indicando como Asunto: “LOPD, Derechos ARCO”, y adjuntando fotocopia de su DNI o cualquier medio análogo en derecho, tal y como indica la ley. Tiene derecho a retirar el consentimiento prestado en cualquier momento. La retirada del consentimiento no afectará a la licitud del tratamiento efectuado antes de la retirada del consentimiento. También tiene derecho a presentar una reclamación ante la autoridad de control si considera que pueden haberse visto vulnerados sus derechos en relación a la protección de sus datos (agpd.es).</p>
            <p><strong>CONFIDENCIALIDAD y CESIÓN DE DATOS A TERCEROS</strong></p>
            <p>Los datos que nos facilite se tratarán de forma confidencial. El Prestador ha adoptado todas las medidas técnicas y organizativas y todos los niveles de protección necesarios para garantizar la seguridad en el tratamiento de los datos y evitar su alteración, pérdida, robo, tratamiento o acceso no autorizado, atendido el estado de la tecnología y naturaleza de los datos almacenados. Así mismo, se garantiza también que el tratamiento y registro en ficheros, programas, sistemas o equipos, locales y centros cumplen con los requisitos y condiciones de integridad y seguridad establecidas en la normativa vigente.</p>
            <p>LA INDUSTRIAL ALGODONERA, S.A. no cederá los datos personales a terceros, excepto por obligación legal. Sin embargo, en el caso de ser cedidos a algún tercero, se produciría una información previa solicitando el consentimiento expreso para tal cesión. La entidad responsable de la base de datos, así como los que intervengan en cualquier fase del tratamiento y/o las entidades a quienes se los haya comunicado -en todo caso siempre con la correspondiente autorización otorgada por el usuario-, están obligadas a observar el secreto profesional y la adopción de los niveles de protección y las medidas técnicas y organizativas necesarias a su alcance para garantizar la seguridad de los datos de carácter personal, evitando, dentro de lo posible, accesos no autorizados, modificaciones ilícitas, sustracciones y/o la pérdida de los datos, con objeto de procurar el correspondiente nivel de seguridad de los ficheros del prestamista, según la naturaleza y sensibilidad de los datos facilitados por los usuarios del presente Sitio web.</p>
            <p><strong>ACEPTACIÓN Y CONSENTIMIENTO</strong></p>
            <p>El Usuario declara haber sido informado de las condiciones sobre protección de datos de carácter personal, aceptando y consintiendo el tratamiento automatizado de los mismos por parte de LA INDUSTRIAL ALGODONERA, S.A. en la forma y para las finalidades indicadas en la presente Política de Protección de Datos Personales.</p>
            <p>Por lo tanto, al utilizar este formulario para contactar con LA INDUSTRIAL ALGODONERA, S.A., está autorizando expresamente la utilización de sus datos para el envío de comunicaciones comerciales, a través de cualquier medio (incluyendo correo electrónico), pudiendo anular esta autorización cuando lo desee, dirigiéndose a LA INDUSTRIAL ALGODONERA, S.A. a través de los medios establecidos.</p>
            <p>A través de esta Política de Privacidad le informamos que las fotografías que estén colgadas en la web son propiedad de LA INDUSTRIAL ALGODONERA, S.A..</p>
            <p><strong>EXACTITUD Y VERACIDAD DE LOS DATOS</strong></p>
            <p>El usuario es el único responsable de la veracidad y corrección de los datos que remita a LA INDUSTRIAL ALGODONERA, S.A., exonerando al Prestador de cualquier responsabilidad al respeto. Los usuarios garantizan y responden, en cualquier caso, de la exactitud, vigencia y autenticidad de los datos personales facilitados, y se comprometen a mantenerlos debidamente actualizados. El usuario acepta proporcionar información completa y correcta en el formulario de registro o suscripción.</p>
            <p><strong>CONTENIDO DE LA WEB Y ENLACES (LINKS)</strong></p>
            <p>LA INDUSTRIAL ALGODONERA, S.A. se reserva el derecho a actualizar, modificar o eliminar la información contenida en la web, pudiendo, incluso, limitar o no permitir el acceso a la información.</p>
            <p>LA INDUSTRIAL ALGODONERA, S.A. no asume ningún tipo de responsabilidad por la información contenida en las Webs de terceros a las que se pueda acceder por los «links» o enlaces desde cualquier página Web propiedad del prestamista.</p>
            <p>La presencia de «links» o enlaces sólo tienen finalidad informativa y en ningún caso supone ninguna sugerencia, invitación o reconocimiento sobre los mismos.</p>
            <p><strong>SUSCRIPCIÓN A NUESTRA NEWSLETTER</strong></p>
            <p>En el supuesto de que el usuario se suscriba le informamos que los datos aportados serán tratados para gestionar su suscripción con aviso de actualización y que se conservarán mientras haya un interés mutuo para mantener el fin del tratamiento. Cuando ya no sea necesario para tal fin, se suprimirán con las medidas de seguridad adecuadas para garantizar la pseudonimización de los datos o destrucción total de los mismos. No se comunicarán los datos a terceros, excepto obligación legal.</p>
            <p><strong>CAMBIOS EN LA PRESENTE POLÍTICA DE PRIVACIDAD</strong></p>
            <p>LA INDUSTRIAL ALGODONERA, S.A. se reserva el derecho a modificar la presente política para adaptarla a novedades legislativas o jurisprudenciales.</p>
            <p><strong>CORREOS COMERCIALES</strong></p>
            <p>De acuerdo con la LSSICE, LA INDUSTRIAL ALGODONERA, S.A. no realiza prácticas de SPAM, por lo tanto, no envía correos comerciales por e-mail que no hayan sido previamente solicitados o autorizados por el Usuario. En consecuencia, en cada uno de los formularios de la Página Web, el Usuario tiene la posibilidad de dar su consentimiento expreso para recibir nuestro Boletín, con independencia de la información comercial puntualmente solicitada.</p>
            <p><strong>LEGISLACIÓN</strong></p>
            <p>Con carácter general las relaciones entre LA INDUSTRIAL ALGODONERA, S.A. con los Usuarios de sus servicios telemáticos, presentes en esta Web, están sometidos a la legislación y jurisdicción españolas a la que se someten expresamente las partes, siendo competentes para la resolución de todos los conflictos derivados o relacionados con su uso los Juzgados y Tribunales de Reus.</p>',
            'ca' => '<p><strong>LA INDUSTRIAL ALGODONERA, S.A</strong>, com a responsable del present Lloc Web i de conformitat amb el que disposa la normativa vigent en matèria de protecció de dades personals, el Reglament (UE) 2016/679 de 27 d’abril de 2016 (RGPD) relatiu a la protecció de les persones físiques pel que fa al tractament de dades personals i a la lliure circulació d’aquestes dades, la Llei Orgànica 15/1999, de 13 de desembre, de Protecció de Dades de Caràcter Personal (LOPD) i per la Llei 34/2002, de 11 de juliol, de Serveis de la Societat de la Informació i del Comerç Electrònic (LSSICE), té implementades totes les mesures de seguretat, d’ índole tècnica i organitzatives, establertes en el Reial Decret 1720/2007 de 21 de Desembre, (que desenvolupa la LOPD) per garantir i protegir la confidencialitat, integritat i disponibilitat de les dades introduïdes.</p>
            <p>A efectes del que preveu la LOPD, <a href="https://www.laindustrialalgodonera.com/ca/">LA INDUSTRIAL ALGODONERA, S.A</a> li informa que les dades que voluntàriament ens està facilitant seran incorporades als nostres sistemes d’informació amb la finalitat de realitzar les gestions comercials i administratives necessàries amb els usuaris de la web; Les operacions previstes per realitzar els tractaments són els següents: respondre a les consultes i/o proporcionar informacions requerides per l’ Usuari; realitzar les prestacions de serveis i/o productes contractats o subscrits per l’ Usuari; realitzar totes aquelles activitats pròpies de LA INDUSTRIAL ALGODONERA, S.A pel present avís legal ressenyades. i remetre el butlletí de notícies de la pàgina web.</p>
            <p>El firmant garanteix la veracitat de les dades aportades i es compromet a comunicar qualsevol canvi que es produeixi en els mateixos.</p>
            <p>El Prestador, mitjançant asterisc (*) en les caselles corresponents del formulari de contacte, li informa d’aquesta obligatorietat a l’Usuari, indicant quines dades són necessàries. Mitjançant la indicació i introducció de les dades, l’Usuari atorga el consentiment inequívoc a LA INDUSTRIAL ALGODONERA, S.A per a procedeixi al tractament de les dades facilitades en pro de les finalitats mencionades.</p>
            <p>El no facilitar les dades personals sol·licitades o el no acceptar la present política de protecció de dades suposa la impossibilitat de subscriure’s, registrar-se o rebre informació dels productes i serveis del prestador.</p>
            <p>De conformitat amb el que disposen les normatives vigents en protecció de dades personals, el prestador està complint amb totes les disposicions de les normatives RGPD i LOPD per al tractament de les dades personals de la seva responsabilitat, i manifestament amb els principis descrits a l’art. 5 del RGPD i a l’art. 4 de la LOPD, pels quals són tractats de manera lícita, lleial i transparent en relació amb l’interessat i adequades, pertinents i limitats al que necessari en relació amb els fins per als quals són tractats.</p>
            <p>El Responsable garanteix que ha implementat polítiques tècniques i organitzatives apropiades per aplicar les mesures de seguretat que estableixen el RGPD i la LOPD per tal de protegir els drets i llibertats dels Usuaris.</p>
            <p>D’ acord amb aquestes normatives, doncs, li informem que té dret a sol·licitar l’accés, rectificació, portabilitat i supressió de les seves dades i la limitació i oposició al seu tractament dirigint-se a <a href="mailto:marketing@laindustrialalgodonera.com">marketing@laindustrialalgodonera.com</a> o mitjançant una carta a C/Sant Rafael Nº 21 (CP.43470) de la Selva del Camp,indicant com Assumpte: “LOPD, Drets ARCO”, i adjuntant fotocopia del seu DNI o qualsevol mitjà anàleg en dret, tal i como indica la llei. Té dret a enretirar el consentiment prestat en qualsevol moment. La retirada del consentiment no afectarà a la licitud del tractament efectuat abans de la retirada del consentiment. També té dret a presentar una reclamació davant l’autoritat de control si considera que poden haver-se vist vulnerats els seus drets en relació a la protecció de les seves dades (agpd.es).</p>
            <p><strong>CONFIDENCIALITAT i CESSIÓ DE DADES A TERCERS</strong></p>
            <p>Les dades que ens faciliti es tractaran de forma confidencial. El prestador ha adoptat totes les mesures tècniques i organitzatives i tots els nivells de protecció necessaris per a garantir la seguretat en el tractament de les dades i evitar la seva alteració, pèrdua, robatori, tractament o accés no autoritzat, atès l’estat de la tecnologia i naturalesa de les dades emmagatzemades. Així mateix. es garanteix també que el tractament i registre en fitxers, programes, sistemes o equips, locals i centres compleixen amb els requisits i condicions de integritat i seguretat establertes en la normativa vigent.</p>
            <p>LA INDUSTRIAL ALGODONERA, S.A no cedirà les dades personals a tercers, excepte per obligació legal No obstant això, en el cas de ser cedits a algun tercer es produiria una informació prèvia sol·licitant el consentiment exprés per tal cessió. L’ entitat responsable de la base de dades, així com els que intervinguin en qualsevol fase del tractament i/o les entitats a les qui se’ls hagi comunicat -en tot cas sempre amb la corresponent autorització atorgada per l’usuari-, estan obligades a observar el secret professional i a l’adopció dels nivells de protecció i les mesures tècniques i organitzatives necessàries al seu abast per garantir la seguretat de les dades de caràcter personal, evitant, en la mesura del possible, accessos no autoritzats, modificacions il·lícites, sostraccions i/o la pèrdua de les dades, a fi de procurar el corresponent nivell de seguretat dels fitxers del prestador, segons la naturalesa i sensibilitat de les dades facilitades pels usuaris del present Lloc Web.</p>
            <p><strong>ACCEPTACIÓ I CONSENTIMENT</strong></p>
            <p>L’ Usuari declara haver sigut informat de les condicions sobre protecció de dades de caràcter personal, acceptant i consentint el tractament automatitzat dels mateixos per part de LA INDUSTRIAL ALGODONERA, S.A en la forma i per a les finalitats indicades en la present Política de Protecció de Dades Personals.</p>
            <p>Per tant, a l’ utilitzar aquest formulari per contactar amb LA INDUSTRIAL ALGODONERA, S.A, està autoritzant expressament la utilització de les seves dades per l’enviament de comunicacions comercials, per qualsevol mitjà (incloent correu electrònic), podent anul·lar aquesta autorització quan ho desitgi, dirigint-se a LA INDUSTRIAL ALGODONERA, S.A a través dels mitjans establerts.</p>
            <p>A través d’ aquesta Política de Privacitat li informem que les fotografies que estiguin penjades a la web són propietat de LA INDUSTRIAL ALGODONERA, S.A.</p>
            <p><strong>EXACTITUD I VERACITAT DE LES DADES</strong></p>
            <p>L’ Usuari és l’ únic responsable de la veracitat i correcció de les dades que remeti a LA INDUSTRIAL ALGODONERA, S.A, exonerant al Prestador de qualsevol responsabilitat al respecte. Els usuaris garanteixen i responen, en qualsevol cas, de l’ exactitud, vigència i autenticitat de les dades personals facilitades, i es comprometen a mantenir-los degudament actualitzats. L’ usuari accepta proporcionar informació completa i correcta en el formulari de registre o subscripció.</p>
            <p><strong>CONTINGUT DE LA WEB I ENLLAÇOS (LINKS)</strong></p>
            <p>LA INDUSTRIAL ALGODONERA, S.A es reserva el dret a actualitzar, modificar o eliminar la informació continguda en la web, podent, inclús, limitar o no permetre l’ accés a la informació.</p>
            <p>LA INDUSTRIAL ALGODONERA, S.A no assumeix cap tipus de responsabilitat per la informació continguda en les Webs de tercers a les que es pugui accedir pels “links” o enllaços des de qualsevol pàgina Web propietat del prestador.</p>
            <p>La presencia de “links” o enllaços només tenen finalitat informativa i en cap cas suposa cap suggerència, invitació o reconeixement sobre els mateixos.</p>
            <p><strong>SUBSCRIPCIÓ A LA NOSTRA NEWSLETTER</strong></p>
            <p>En el cas que l’usuari es subscrigui li informem que les dades aportades seran tractades per gestionar la seva subscripció amb avís d’actualització i que es conservaran mentre hi hagi un interès mutu per mantenir la fi del tractament. Quan ja no sigui necessari per a tal fi, es suprimiran amb mesures de seguretat adequades per garantir la seudonimització de les dades o destrucció total dels mateixos. No es comunicaran les dades a tercers, excepte obligació legal.</p>
            <p><strong>CANVIS EN LA PRESENT POLÍTICA DE PRIVACITAT</strong></p>
            <p>LA INDUSTRIAL ALGODONERA, S.A es reserva el dret a modificar la present política per adaptar-la a novetats legislatives o jurisprudencials.</p>
            <p><strong>CORREUS COMERCIALS</strong></p>
            <p>D’acord amb la LSSICE, LA INDUSTRIAL ALGODONERA, S.A no realitza pràctiques d’ SPAM, per tant, no envia correus comercials per e-mail que no hagin sigut prèviament sol·licitats o autoritzats per l’ Usuari. En conseqüència, en cada un dels formularis de la Pàgina Web, l’ Usuari té la possibilitat de donar el seu consentiment exprés per a rebre el nostre Butlletí, amb independència de la informació comercial puntualment sol·licitada.</p>
            <p><strong>LEGISLACIÓ</strong></p>
            <p>Amb caràcter general les relacions entre LA INDUSTRIAL ALGODONERA, S.A amb els Usuaris dels seus serveis telemàtics, presents en aquesta Web, estan sotmesos a la legislació i jurisdicció espanyoles a la que es sotmeten expressament les parts, essent competents per la resolució de tots els conflictes derivats o relacionats amb el seu ús els Jutjats i Tribunals de Reus.</p>',
            'en' => '<p><strong>LA INDUSTRIAL ALGODONERA, S.A.</strong> is responsible for this Website and in accordance with the provisions of current regulations on the protection of personal data, Regulation (EU) 2016/679 of 27 April, 2016 (GDPR) in relation to the protection of natural persons with regard to the processing of personal data and the free circulation of said data, Spanish Organic Law 15/1999, of 13 December, on the Protection of Personal Data (LOPD) and Spanish Law 34/2002, of 11 July, on the Information Society and Electronic Commerce Services (LSSICE), has implemented all security measures, both technical and organisational, established by the Spanish Royal Decree 1720/2007 of 21 December (which develops the LOPD) to guarantee and protect confidentiality, integrity, and availability of the data entered.</p>
            <p>For the purposes of the provisions of the LOPD, LA INDUSTRIAL ALGODONERA, S.A. informs you that the information you are voluntarily providing us will be incorporated into our information systems in order to carry out the necessary commercial and administrative procedures with website users. The operations foreseen to be carried out are as follows: respond to inquiries and/or provide information requested by the User; perform the provision of services and/or products contracted or subscribed to by the User; carry out all those activities of LA INDUSTRIAL ALGODONERA, S.A. described in this legal notice, and submit the website newsletter.</p>
            <p>The signer guarantees the veracity of data provided and undertakes the need to communicate any changes that may occur in them.</p>
            <p>The Provider, marked by an asterisk (*) in the corresponding boxes of the contact form, informs the User of these obligations, indicating what data is necessary. By indicating and entering the data, the User grants unambiguous consent to LA INDUSTRIAL ALGODONERA, S.A. to proceed with the processing of said data provided for the purposes previously mentioned.</p>
            <p>Failure to provide the requested personal data or failure to accept this data protection policy means that it is impossible to subscribe, register, or receive information about the Provider’s products and services.</p>
            <p>In accordance with the regulations in force regarding the protection of personal data, the Provider is complying with all the provisions of the GDPR and LOPD for the treatment of personal data in their responsibility, markedly with the principles described in Article 5 of the GDPR and in Article 4 of the LOPD, by which they are treated in a lawful, loyal and transparent manner in relation to the interested party and adequate, relevant, and limited to what is necessary in relation to the purposes for which they are treated.</p>
            <p>The Data Controller guarantees that he has implemented appropriate technical and organisational policies to apply the security measures established by the GDPR and the LOPD to protect the rights and freedoms of the Users.</p>
            <p>In accordance with these regulations, then, we inform you that you have the right to request access, rectification, portability, and deletion of your data and the limitation and opposition to your treatment via email to <a href="mailto:marketing@laindustrialalgodonera.com">marketing@laindustrialalgodonera.com</a> or letter to C/Sant Rafael Nº 21 (CP.43470) La Selva del Camp, indicating as Subject: “LOPD, ARCO Rights”, and attaching a photocopy of your ID or any similar legal identification, as indicated by law. You have the right to withdraw the consent given at any time. The withdrawal of consent will not affect the lawfulness of the treatment carried out before the withdrawal of consent. You also have the right to submit a claim to the supervisory authority if you believe that your rights may have been violated in relation to the protection of your data (agpd.es).</p>
            <p><strong>CONFIDENTIALITY AND TRANSFER OF DATA TO THIRD PARTIES</strong></p>
            <p>The information you provide will be treated confidentially. The Provider has adopted all the technical and organisational measures and all the levels of protection necessary to guarantee the security in the treatment of the data and to avoid its alteration, loss, theft, treatment, or unauthorized access, according to the state of technology and nature of the stored data. Likewise, it is also guaranteed that the treatment and registration in files, programs, systems or equipment, premises, and centres comply with the requirements and conditions of integrity and security as established in the current regulations.</p>
            <p>LA INDUSTRIAL ALGODONERA, S.A. will not transfer personal data to third parties, except by legal obligation. However, in the case of being transferred to a third party, information would be prior obtained by the User requesting the express consent for such assignment. The entity responsible for the database, as well as those that intervene in any phase of the treatment, and/or the entities to which they have been notified, -in any case always with the corresponding authorisation granted by the user-, are obligated to observe professional secrecy, the adoption of protection levels, as well as technical and organizational measures necessary to ensure the security of personal data, avoiding, as far as possible, unauthorised access, illegal modifications, subtractions and/or loss of data, in order to ensure the corresponding level of security of the providers’ files, according to the nature and sensitivity of the data provided by the users of this Website.</p>
            <p><strong>ACCEPTANCE AND CONSENT</strong></p>
            <p>The User declares to have been informed of the conditions regarding the protection of personal data, accepting and consenting to the automatic treatment of said data by LA INDUSTRIAL ALGODONERA, S.A., in the manner and for the purposes indicated in this Policy of Protection of Personal Data.</p>
            <p>Therefore, when using this form to contact LA INDUSTRIAL ALGODONERA, S.A., you are expressly authorising the use of your data for sending commercial correspondence by any means (including email) and can revoke this authorisation at any time, by contacting LA INDUSTRIAL ALGODONERA, S.A. through the established methods.</p>
            <p>Through this Privacy Policy we inform you that the photographs that are posted on the website are the property of LA INDUSTRIAL ALGODONERA, S.A..</p>
            <p><strong>ACCURACY AND TRUTHFULNESS OF DATA</strong></p>
            <p>The User is solely responsible for the accuracy and veracity of the data sent to LA INDUSTRIAL ALGODONERA, S.A., exonerating the Provider of any responsibility in this respect. Users guarantee and are held liable, in any case, regarding the accuracy, validity, and authenticity of the personal data provided, and undertake to keep the data provided properly updated. The user agrees to provide complete and correct information in the registration or subscription form.</p>
            <p><strong>CONTENT OF WEBSITE AND WEBLINKS</strong></p>
            <p>LA INDUSTRIAL ALGODONERA, S.A. reserves the right to update, modify, or eliminate the information contained in the website, and may even limit or refuse access to information.</p>
            <p>LA INDUSTRIAL ALGODONERA, S.A. does not assume any type of responsibility for the information contained in the websites of third parties that can be accessed through the links from any Web page owned by the Provider.</p>
            <p>The presence of links is for informational purposes only and in no case does it imply any suggestion, invitation, or acknowledgment regarding them.</p>
            <p><strong>SUBSCRIPTION TO OUR NEWSLETTER</strong></p>
            <p>In the event that the user subscribes to our newsletter, we inform you that the information provided will be processed to manage your subscription with update notices and that it will be kept as long as there is a mutual interest to maintain the end the treatment. When it is no longer necessary for this purpose, it will be eliminated with adequate security measures to guarantee the pseudonymisation of the data or the total destruction of the data. The data will not be communicated to third parties, except when there is a legal obligation to do so.</p>
            <p><strong>CHANGES IN THIS PRIVACY POLICY</strong></p>
            <p>LA INDUSTRIAL ALGODONERA, S.A. reserves the right to modify the current policy in order to adapt it to new legislation or jurisprudence.</p>
            <p><strong>COMMERCIAL MAIL</strong></p>
            <p>According to the LSSICE, LA INDUSTRIAL ALGODONERA, S.A. does not perform SPAM practices, therefore, does not send commercial e-mails that have not been previously requested or authorised by the User. Consequently, in each of the forms of the Web Page, the User has the possibility of giving his express consent to receive our Bulletin e-mails, regardless of the commercial information occasionally requested.</p>
            <p><strong>LEGISLATION</strong></p>
            <p>For all purposes, the relations between LA INDUSTRIAL ALGODONERA, S.A. and the Users of its telematic services, present on this Website, are subject to the Spanish legislation and jurisdiction to which the parties expressly submit, being competent for the resolution of all disputes arising or related to their use the Courts of Reus.</p>',
            'fr' => '<p><strong>LA INDUSTRIAL ALGODONERA, S.A.</strong> is responsible for this Website and in accordance with the provisions of current regulations on the protection of personal data, Regulation (EU) 2016/679 of 27 April, 2016 (GDPR) in relation to the protection of natural persons with regard to the processing of personal data and the free circulation of said data, Spanish Organic Law 15/1999, of 13 December, on the Protection of Personal Data (LOPD) and Spanish Law 34/2002, of 11 July, on the Information Society and Electronic Commerce Services (LSSICE), has implemented all security measures, both technical and organisational, established by the Spanish Royal Decree 1720/2007 of 21 December (which develops the LOPD) to guarantee and protect confidentiality, integrity, and availability of the data entered.</p>
            <p>For the purposes of the provisions of the LOPD, LA INDUSTRIAL ALGODONERA, S.A. informs you that the information you are voluntarily providing us will be incorporated into our information systems in order to carry out the necessary commercial and administrative procedures with website users. The operations foreseen to be carried out are as follows: respond to inquiries and/or provide information requested by the User; perform the provision of services and/or products contracted or subscribed to by the User; carry out all those activities of LA INDUSTRIAL ALGODONERA, S.A. described in this legal notice, and submit the website newsletter.</p>
            <p>The signer guarantees the veracity of data provided and undertakes the need to communicate any changes that may occur in them.</p>
            <p>The Provider, marked by an asterisk (*) in the corresponding boxes of the contact form, informs the User of these obligations, indicating what data is necessary. By indicating and entering the data, the User grants unambiguous consent to LA INDUSTRIAL ALGODONERA, S.A. to proceed with the processing of said data provided for the purposes previously mentioned.</p>
            <p>Failure to provide the requested personal data or failure to accept this data protection policy means that it is impossible to subscribe, register, or receive information about the Provider’s products and services.</p>
            <p>In accordance with the regulations in force regarding the protection of personal data, the Provider is complying with all the provisions of the GDPR and LOPD for the treatment of personal data in their responsibility, markedly with the principles described in Article 5 of the GDPR and in Article 4 of the LOPD, by which they are treated in a lawful, loyal and transparent manner in relation to the interested party and adequate, relevant, and limited to what is necessary in relation to the purposes for which they are treated.</p>
            <p>The Data Controller guarantees that he has implemented appropriate technical and organisational policies to apply the security measures established by the GDPR and the LOPD to protect the rights and freedoms of the Users.</p>
            <p>In accordance with these regulations, then, we inform you that you have the right to request access, rectification, portability, and deletion of your data and the limitation and opposition to your treatment via email to <a href="mailto:marketing@laindustrialalgodonera.com">marketing@laindustrialalgodonera.com</a> or letter to C/Sant Rafael Nº 21 (CP.43470) La Selva del Camp, indicating as Subject: “LOPD, ARCO Rights”, and attaching a photocopy of your ID or any similar legal identification, as indicated by law. You have the right to withdraw the consent given at any time. The withdrawal of consent will not affect the lawfulness of the treatment carried out before the withdrawal of consent. You also have the right to submit a claim to the supervisory authority if you believe that your rights may have been violated in relation to the protection of your data (agpd.es).</p>
            <p><strong>CONFIDENTIALITY AND TRANSFER OF DATA TO THIRD PARTIES</strong></p>
            <p>The information you provide will be treated confidentially. The Provider has adopted all the technical and organisational measures and all the levels of protection necessary to guarantee the security in the treatment of the data and to avoid its alteration, loss, theft, treatment, or unauthorized access, according to the state of technology and nature of the stored data. Likewise, it is also guaranteed that the treatment and registration in files, programs, systems or equipment, premises, and centres comply with the requirements and conditions of integrity and security as established in the current regulations.</p>
            <p>LA INDUSTRIAL ALGODONERA, S.A. will not transfer personal data to third parties, except by legal obligation. However, in the case of being transferred to a third party, information would be prior obtained by the User requesting the express consent for such assignment. The entity responsible for the database, as well as those that intervene in any phase of the treatment, and/or the entities to which they have been notified, -in any case always with the corresponding authorisation granted by the user-, are obligated to observe professional secrecy, the adoption of protection levels, as well as technical and organizational measures necessary to ensure the security of personal data, avoiding, as far as possible, unauthorised access, illegal modifications, subtractions and/or loss of data, in order to ensure the corresponding level of security of the providers’ files, according to the nature and sensitivity of the data provided by the users of this Website.</p>
            <p><strong>ACCEPTANCE AND CONSENT</strong></p>
            <p>The User declares to have been informed of the conditions regarding the protection of personal data, accepting and consenting to the automatic treatment of said data by LA INDUSTRIAL ALGODONERA, S.A., in the manner and for the purposes indicated in this Policy of Protection of Personal Data.</p>
            <p>Therefore, when using this form to contact LA INDUSTRIAL ALGODONERA, S.A., you are expressly authorising the use of your data for sending commercial correspondence by any means (including email) and can revoke this authorisation at any time, by contacting LA INDUSTRIAL ALGODONERA, S.A. through the established methods.</p>
            <p>Through this Privacy Policy we inform you that the photographs that are posted on the website are the property of LA INDUSTRIAL ALGODONERA, S.A..</p>
            <p><strong>ACCURACY AND TRUTHFULNESS OF DATA</strong></p>
            <p>The User is solely responsible for the accuracy and veracity of the data sent to LA INDUSTRIAL ALGODONERA, S.A., exonerating the Provider of any responsibility in this respect. Users guarantee and are held liable, in any case, regarding the accuracy, validity, and authenticity of the personal data provided, and undertake to keep the data provided properly updated. The user agrees to provide complete and correct information in the registration or subscription form.</p>
            <p><strong>CONTENT OF WEBSITE AND WEBLINKS</strong></p>
            <p>LA INDUSTRIAL ALGODONERA, S.A. reserves the right to update, modify, or eliminate the information contained in the website, and may even limit or refuse access to information.</p>
            <p>LA INDUSTRIAL ALGODONERA, S.A. does not assume any type of responsibility for the information contained in the websites of third parties that can be accessed through the links from any Web page owned by the Provider.</p>
            <p>The presence of links is for informational purposes only and in no case does it imply any suggestion, invitation, or acknowledgment regarding them.</p>
            <p><strong>SUBSCRIPTION TO OUR NEWSLETTER</strong></p>
            <p>In the event that the user subscribes to our newsletter, we inform you that the information provided will be processed to manage your subscription with update notices and that it will be kept as long as there is a mutual interest to maintain the end the treatment. When it is no longer necessary for this purpose, it will be eliminated with adequate security measures to guarantee the pseudonymisation of the data or the total destruction of the data. The data will not be communicated to third parties, except when there is a legal obligation to do so.</p>
            <p><strong>CHANGES IN THIS PRIVACY POLICY</strong></p>
            <p>LA INDUSTRIAL ALGODONERA, S.A. reserves the right to modify the current policy in order to adapt it to new legislation or jurisprudence.</p>
            <p><strong>COMMERCIAL MAIL</strong></p>
            <p>According to the LSSICE, LA INDUSTRIAL ALGODONERA, S.A. does not perform SPAM practices, therefore, does not send commercial e-mails that have not been previously requested or authorised by the User. Consequently, in each of the forms of the Web Page, the User has the possibility of giving his express consent to receive our Bulletin e-mails, regardless of the commercial information occasionally requested.</p>
            <p><strong>LEGISLATION</strong></p>
            <p>For all purposes, the relations between LA INDUSTRIAL ALGODONERA, S.A. and the Users of its telematic services, present on this Website, are subject to the Spanish legislation and jurisdiction to which the parties expressly submit, being competent for the resolution of all disputes arising or related to their use the Courts of Reus.</p>',
            'it' => '<p><strong>LA INDUSTRIAL ALGODONERA, S.A.</strong> is responsible for this Website and in accordance with the provisions of current regulations on the protection of personal data, Regulation (EU) 2016/679 of 27 April, 2016 (GDPR) in relation to the protection of natural persons with regard to the processing of personal data and the free circulation of said data, Spanish Organic Law 15/1999, of 13 December, on the Protection of Personal Data (LOPD) and Spanish Law 34/2002, of 11 July, on the Information Society and Electronic Commerce Services (LSSICE), has implemented all security measures, both technical and organisational, established by the Spanish Royal Decree 1720/2007 of 21 December (which develops the LOPD) to guarantee and protect confidentiality, integrity, and availability of the data entered.</p>
            <p>For the purposes of the provisions of the LOPD, LA INDUSTRIAL ALGODONERA, S.A. informs you that the information you are voluntarily providing us will be incorporated into our information systems in order to carry out the necessary commercial and administrative procedures with website users. The operations foreseen to be carried out are as follows: respond to inquiries and/or provide information requested by the User; perform the provision of services and/or products contracted or subscribed to by the User; carry out all those activities of LA INDUSTRIAL ALGODONERA, S.A. described in this legal notice, and submit the website newsletter.</p>
            <p>The signer guarantees the veracity of data provided and undertakes the need to communicate any changes that may occur in them.</p>
            <p>The Provider, marked by an asterisk (*) in the corresponding boxes of the contact form, informs the User of these obligations, indicating what data is necessary. By indicating and entering the data, the User grants unambiguous consent to LA INDUSTRIAL ALGODONERA, S.A. to proceed with the processing of said data provided for the purposes previously mentioned.</p>
            <p>Failure to provide the requested personal data or failure to accept this data protection policy means that it is impossible to subscribe, register, or receive information about the Provider’s products and services.</p>
            <p>In accordance with the regulations in force regarding the protection of personal data, the Provider is complying with all the provisions of the GDPR and LOPD for the treatment of personal data in their responsibility, markedly with the principles described in Article 5 of the GDPR and in Article 4 of the LOPD, by which they are treated in a lawful, loyal and transparent manner in relation to the interested party and adequate, relevant, and limited to what is necessary in relation to the purposes for which they are treated.</p>
            <p>The Data Controller guarantees that he has implemented appropriate technical and organisational policies to apply the security measures established by the GDPR and the LOPD to protect the rights and freedoms of the Users.</p>
            <p>In accordance with these regulations, then, we inform you that you have the right to request access, rectification, portability, and deletion of your data and the limitation and opposition to your treatment via email to <a href="mailto:marketing@laindustrialalgodonera.com">marketing@laindustrialalgodonera.com</a> or letter to C/Sant Rafael Nº 21 (CP.43470) La Selva del Camp, indicating as Subject: “LOPD, ARCO Rights”, and attaching a photocopy of your ID or any similar legal identification, as indicated by law. You have the right to withdraw the consent given at any time. The withdrawal of consent will not affect the lawfulness of the treatment carried out before the withdrawal of consent. You also have the right to submit a claim to the supervisory authority if you believe that your rights may have been violated in relation to the protection of your data (agpd.es).</p>
            <p><strong>CONFIDENTIALITY AND TRANSFER OF DATA TO THIRD PARTIES</strong></p>
            <p>The information you provide will be treated confidentially. The Provider has adopted all the technical and organisational measures and all the levels of protection necessary to guarantee the security in the treatment of the data and to avoid its alteration, loss, theft, treatment, or unauthorized access, according to the state of technology and nature of the stored data. Likewise, it is also guaranteed that the treatment and registration in files, programs, systems or equipment, premises, and centres comply with the requirements and conditions of integrity and security as established in the current regulations.</p>
            <p>LA INDUSTRIAL ALGODONERA, S.A. will not transfer personal data to third parties, except by legal obligation. However, in the case of being transferred to a third party, information would be prior obtained by the User requesting the express consent for such assignment. The entity responsible for the database, as well as those that intervene in any phase of the treatment, and/or the entities to which they have been notified, -in any case always with the corresponding authorisation granted by the user-, are obligated to observe professional secrecy, the adoption of protection levels, as well as technical and organizational measures necessary to ensure the security of personal data, avoiding, as far as possible, unauthorised access, illegal modifications, subtractions and/or loss of data, in order to ensure the corresponding level of security of the providers’ files, according to the nature and sensitivity of the data provided by the users of this Website.</p>
            <p><strong>ACCEPTANCE AND CONSENT</strong></p>
            <p>The User declares to have been informed of the conditions regarding the protection of personal data, accepting and consenting to the automatic treatment of said data by LA INDUSTRIAL ALGODONERA, S.A., in the manner and for the purposes indicated in this Policy of Protection of Personal Data.</p>
            <p>Therefore, when using this form to contact LA INDUSTRIAL ALGODONERA, S.A., you are expressly authorising the use of your data for sending commercial correspondence by any means (including email) and can revoke this authorisation at any time, by contacting LA INDUSTRIAL ALGODONERA, S.A. through the established methods.</p>
            <p>Through this Privacy Policy we inform you that the photographs that are posted on the website are the property of LA INDUSTRIAL ALGODONERA, S.A..</p>
            <p><strong>ACCURACY AND TRUTHFULNESS OF DATA</strong></p>
            <p>The User is solely responsible for the accuracy and veracity of the data sent to LA INDUSTRIAL ALGODONERA, S.A., exonerating the Provider of any responsibility in this respect. Users guarantee and are held liable, in any case, regarding the accuracy, validity, and authenticity of the personal data provided, and undertake to keep the data provided properly updated. The user agrees to provide complete and correct information in the registration or subscription form.</p>
            <p><strong>CONTENT OF WEBSITE AND WEBLINKS</strong></p>
            <p>LA INDUSTRIAL ALGODONERA, S.A. reserves the right to update, modify, or eliminate the information contained in the website, and may even limit or refuse access to information.</p>
            <p>LA INDUSTRIAL ALGODONERA, S.A. does not assume any type of responsibility for the information contained in the websites of third parties that can be accessed through the links from any Web page owned by the Provider.</p>
            <p>The presence of links is for informational purposes only and in no case does it imply any suggestion, invitation, or acknowledgment regarding them.</p>
            <p><strong>SUBSCRIPTION TO OUR NEWSLETTER</strong></p>
            <p>In the event that the user subscribes to our newsletter, we inform you that the information provided will be processed to manage your subscription with update notices and that it will be kept as long as there is a mutual interest to maintain the end the treatment. When it is no longer necessary for this purpose, it will be eliminated with adequate security measures to guarantee the pseudonymisation of the data or the total destruction of the data. The data will not be communicated to third parties, except when there is a legal obligation to do so.</p>
            <p><strong>CHANGES IN THIS PRIVACY POLICY</strong></p>
            <p>LA INDUSTRIAL ALGODONERA, S.A. reserves the right to modify the current policy in order to adapt it to new legislation or jurisprudence.</p>
            <p><strong>COMMERCIAL MAIL</strong></p>
            <p>According to the LSSICE, LA INDUSTRIAL ALGODONERA, S.A. does not perform SPAM practices, therefore, does not send commercial e-mails that have not been previously requested or authorised by the User. Consequently, in each of the forms of the Web Page, the User has the possibility of giving his express consent to receive our Bulletin e-mails, regardless of the commercial information occasionally requested.</p>
            <p><strong>LEGISLATION</strong></p>
            <p>For all purposes, the relations between LA INDUSTRIAL ALGODONERA, S.A. and the Users of its telematic services, present on this Website, are subject to the Spanish legislation and jurisdiction to which the parties expressly submit, being competent for the resolution of all disputes arising or related to their use the Courts of Reus.</p>',
        ];

        LanguageLine::create([
            'group' => 'Politicas',
            'key' => 'texto_politica_privacidad',
            'text' => $textos
        ]);

        $textos = [
            'es' => '
            <ol>
            <li><strong>Información Corporativa</strong></li>
            </ol>
            <p>En virtud de las obligaciones establecidas por el Reglamento Europeo de Protección de Datos (RGPD) 2016/679, del 27 de abril de 2016, le informamos que el presente sitio web es propiedad de LA INDUSTRIAL ALGODONERA, SA, con CIF A43000132, y domicilio sito en Raval Sant Rafael Nº 21 (CP.43470) de la Selva del Camp, Tarragona, España.</p>
            <p>Puede contactar con nosotros en el teléfono +34977844000 o a través del correo electrónico <a href="mailto:marketing@laindustrialalgodonera.com">marketing@laindustrialalgodonera.com</a>.</p>
            <p>Esta sociedad consta inscrita en el Registro Mercantil de Tarragona con los siguientes datos registrales: Hoja Tarragona, Folio 128, Tomo 15, Libro de Sociedades. Sección General, CIF A43000132.</p>
            <p>&nbsp;</p>
            <ol start="2">
            <li><strong> Protección de Contenidos</strong></li>
            </ol>
            <p>El usuario reconoce y acepta que todos los derechos de propiedad industrial e intelectual sobre los contenidos y/o cualesquiera otros elementos insertados por &nbsp;LA INDUSTRIAL ALGODONERA, SA en el presente Sitio Web <a href="https://www.laindustrialalgodonera.com/">www.laindustrialalgodonera.com</a> (incluyendo, a título meramente enunciativo y no limitativo, todos aquellos elementos que conforman la apariencia visual, imagen gráfica y otros estímulos sensoriales del sitio web o «look and feel»: marcas, logotipos, nombres comerciales, textos, imágenes, gráficos, diseños, sonidos, bases de datos, software, diagramas de flujo, presentación, arquitectura de navegación, así como los códigos fuente de las páginas web) pertenecen a LA INDUSTRIAL ALGODONERA, SA y/o a terceros a los cuales les han cedido sus derechos.</p>
            <p>En ningún caso el acceso al Sitio Web implica algún tipo de permiso, renuncia, transmisión, licencia o cesión total ni parcial de dichos derechos por parte de sus titulares, salvo que se establezca expresamente lo contrario. Los presentes términos y condiciones de uso del Sitio Web no confieren a los USUARIOS ningún otro derecho de utilización, alteración, explotación, reproducción, distribución o comunicación pública del Sitio Web y/o de sus contenidos distintos de los aquí expresamente previstos.</p>
            <p>Queda terminantemente prohibida la utilización de tales elementos, su total o parcial reproducción, comunicación y/o distribución con fines comerciales o lucrativos, así como su modificación, alteración, descompilación y/o cualquier otro acto de explotación del Sitio Web.</p>
            <p>Sin perjuicio de todo lo anterior, si el Usuario o un tercero estima que algún contenido del Sitio Web pudiera vulnerar derechos de propiedad intelectual e industrial, rogamos así lo pongan en nuestro conocimiento a la mayor brevedad posible.</p>
            <p><strong>&nbsp;</strong></p>
            <ol start="3">
            <li><strong> Acceso y Uso del Sitio Web</strong></li>
            </ol>
            <p>Tanto el acceso al Sitio Web como el uso no consentido que pueda efectuarse de la información contenida en el mismo es de la exclusiva responsabilidad de quien lo realiza.</p>
            <p>El usuario se compromete a utilizar los contenidos, información y datos del Sitio Web de conformidad con las presentes condiciones, términos y políticas, con la normativa de aplicación y con las buenas costumbres generalmente aceptadas y el orden público.</p>
            <p>El usuario se obliga a abstenerse de utilizar los contenidos del Sitio Web con fines o efectos ilícitos, prohibidos o contrarios a los aquí establecidos, lesivos de los derechos e intereses de LA INDUSTRIAL ALGODONERA, SA, de los demás usuarios, de terceros o que de cualquier forma puedan dañar, inutilizar, sobrecargar o deteriorar el presente Sitio Web o impedir la normal utilización o disfrute del mismo por parte de los usuarios.</p>
            <p>LA INDUSTRIAL ALGODONERA, SA. no responderá de ninguna consecuencia, daño o perjuicio que pudiera derivarse de dicho acceso o uso o del incumplimiento de las presentes condiciones, términos y políticas ni se hará responsable de los errores de seguridad que se puedan producir ni de los daños que puedan causarse al sistema informático del usuario (hardware y software) o a los ficheros o documentos almacenados en el mismo como consecuencia de: (I) la presencia de un virus en el ordenador del usuario que sea utilizado para la conexión a los servicios y/o productos ofrecidos por LA INDUSTRIAL ALGODONERA, SA. a través de su Sitio Web; (II) un mal funcionamiento del navegador; (III) el uso de versiones no actualizadas del mismo.</p>
            <p>&nbsp;</p>
            <ol start="4">
            <li><strong> Enlaces a terceros</strong></li>
            </ol>
            <p>En el presente Sitio Web se pueden utilizar enlaces con otras páginas o sitios web. LA INDUSTRIAL ALGODONERA, SA no se responsabiliza ni del contenido ni de las medidas de seguridad adoptadas por cualquier otra página o sitio web a través del cual se tiene acceso desde el presente Sitio Web, sitios a los que accede el interesado bajo su exclusiva responsabilidad.</p>
            <p>Asimismo, tampoco se garantiza la ausencia de virus u otros elementos en los contenidos enlazados desde el Sitio Web de LA INDUSTRIAL ALGODONERA, SA. que puedan producir alteraciones en el sistema informático (hardware y software) y/o en los documentos o los ficheros del Usuario, excluyendo asimismo a LA INDUSTRIAL ALGODONERA, SA de toda responsabilidad derivada de los daños de cualquier índole ocasionados por todo lo anterior.</p>
            <p>&nbsp;</p>
            <ol start="5">
            <li><strong> Redes sociales</strong></li>
            </ol>
            <p>Le informamos qué LA INDUSTRIAL ALGODONERA, SA. puede tener presencia en redes sociales. El tratamiento de los datos que se lleve a cabo de las personas que se hagan seguidoras en las redes sociales (y/o realicen cualquier vínculo o acción de conexión a través de las redes sociales) de las páginas oficiales de LA INDUSTRIAL ALGODONERA, SA. se regirá por este apartado, así como por aquellas condiciones de uso, políticas de privacidad y normativas de acceso que pertenezcan a la red social que proceda en cada caso y aceptadas previamente por el usuario.</p>
            <p>LA INDUSTRIAL ALGODONERA, SA. tratará sus datos con las finalidades de administrar correctamente su presencia en la red social, informándole de actividades productos o servicios de LA INDUSTRIAL ALGODONERA, SA., así como para cualquier otra finalidad que las normativas de las Redes Sociales permitan.</p>
            <p>Queda prohibida la publicación de contenidos:</p>
            <p>– Que sean presuntamente ilícitos por la normativa nacional, comunitaria o internacional o que realicen actividades presuntamente ilícitas o contravengan los principios de la buena fe.</p>
            <p>– Que atenten contra los derechos fundamentales de las personas, falten a la cortesía en la red, molesten o puedan generar opiniones negativas en nuestros usuarios o terceros y en general cualesquiera sean los contenidos que LA INDUSTRIAL ALGODONERA, SA considere no apropiados.</p>
            <p>– Y en general que contravengan los principios de legalidad, honradez, responsabilidad, protección de la dignidad humana, protección de menores, protección del orden público, la protección de la vida privada, la protección del consumidor y los derechos de propiedad intelectual e industrial.</p>
            <p>Asimismo, LA INDUSTRIAL ALGODONERA, SA se reserva la potestad de retirar, sin previo aviso del sitio web o de la red social corporativa aquellos contenidos que se consideren no apropiados.</p>
            <p>&nbsp;</p>
            <ol start="6">
            <li><strong> Modificación de Aviso Legal, Política de Privacidad y de Protección de Datos. </strong></li>
            </ol>
            <p>El Responsable del Sitio Web se reserva el derecho a modificar en todo momento y sin previo aviso las presentes condiciones, términos y políticas de privacidad para adaptarlas a las novedades legislativas o jurisprudenciales así como a las modificaciones o prácticas de la industria, debiendo el usuario consultar periódicamente las presentes condiciones, términos y políticas a fin de comprobar o cerciorarse de la existencia de cambios en las mismas, tomando como referencia la fecha de la última actualización.</p>
            ',
            'ca' => '
            <ol>
            <li><strong> Informació Corporativa</strong></li>
            </ol>
            <p>En virtut de les obligacions establertes pel Reglamento (UE) 2016/679 del Parlamento Europeo y del Consejo, de 27 de abril de 2016, l’informem que aquesta pàgina web és propietat de LA INDUSTRIAL ALGODONERA, SA, amb CIF A43000132, y domicili a Raval Sant Rafael Nº 21 (CP.43470) de la Selva del Camp, Tarragona, Espanya. </p>
            <p>Pot contactar amb nosaltres al telèfon +34977844000 o mitjançant el correu electrònic <a href="mailto:comercial@laindustrialalgodonera.com">comercial@laindustrialalgodonera.com</a>.</p>
            <p>Aquesta societat està inscrita al Registre Mercantil de Tarragona amb les següents dades registrals: Full Tarragona, Foli 128, Tom 15, Llibre de Societats. Secció General, CIF A43000132.</p>
            <p>&nbsp;</p>
            <ol start="2">
            <li><strong> Protecció de Continguts</strong></li>
            </ol>
            <p>L’usuari reconeix i accepta que tots els drets de propietat industrial i intel·lectual sobre els continguts i/o qualsevol altre element inserit per LA INDUSTRIAL ALGODONERA, SA en aquesta pàgina Web <a href="https://www.laindustrialalgodonera.com/ca/">www.laindustrialalgodonera.com</a> (incloent, a títol merament enunciatiu i no limitatiu, tots aquells elements que conformen l’aparença visual, imatge gràfica i altres estímuls sensorials del lloc web o “look and feel”: marques, logotips, noms comercials, textos, imatges, gràfics, dissenys, sons, bases de dades, software, diagrames de flux, presentació, arquitectura de navegació, així com els codis font de les pàgines web) pertanyen a LA INDUSTRIAL ALGODONERA, SA i/o a tercers als quals els han estat cedits els seus drets.</p>
            <p>En cap cas, l’accés al Lloc Web implica algun tipus de permís, renúncia, transmissió, llicència o cessió total ni parcial d’aquests drets per part dels seus titulars, llevat que s’estableixi expressament el contrari. Aquests termes i condicions d’ús del Lloc Web no confereixen als usuaris cap altre dret d’utilització, alteració, explotació, reproducció, distribució o comunicació pública del Lloc Web i/o dels seus continguts diferent als aquí expressament previstos.</p>
            <p>Queda totalment prohibida la utilització d’aquests elements, la seva total o parcial reproducció, comunicació i/o distribució amb finalitats comercials o lucratives, així com la seva modificació, alteració, descompilació i/o qualsevol altre acte d’explotació del Lloc Web.</p>
            <p>Sense perjudici de tot l’esmentat anteriorment, si l’usuari o un tercer estima que algun contingut del Lloc Web pot vulnerar els drets de propietat intel·lectual i industrial, preguem que ho ens ho faci saber al més aviat possible.</p>
            <p>&nbsp;</p>
            <ol start="3">
            <li><strong> Accés i Ús del Lloc Web</strong></li>
            </ol>
            <p>Tant l’accés al Lloc Web com l’ús no consentit que pugui fer-se de la informació continguda a la pàgina és exclusivament responsabilitat de qui ho realitza.</p>
            <p>L’usuari es compromet a utilitzar els continguts, informació i dades del Lloc Web de conformitat amb les condicions, termes i polítiques vigents, amb la normativa d’aplicació i amb els bons costums generalment acceptats i l’ordre públic.</p>
            <p>L’usuari s’abstindrà d’utilitzar els continguts del Lloc Web amb finalitats o efectes il·lícits, prohibits o contraris als aquí establerts, lesius dels drets i interessos de LA INDUSTRIAL ALGODONERA, SA, de la resta d’usuaris, de tercers o que de qualsevol forma puguin danyar, inutilitzar, sobrecarregar o deteriorar aquest Lloc Web o impedir la normal utilització o el fet de gaudir-ne per part dels usuaris.</p>
            <p>LA INDUSTRIAL ALGODONERA, SA no respondrà de cap conseqüència, dany o perjudici que pogués derivar-se d’aquest accés o ús o de l’incompliment de les presents condicions, termes i polítiques ni es farà responsable dels errors de seguretat que es puguin produir ni dels desperfectes que es puguin causar al sistema informàtic de l’usuari (hardware i software) o als fitxers o documents emmagatzemats en aquest com a conseqüència de: (i) la presència d’un virus a l’ordinador de l’usuari que sigui utilitzat per la connexió als serveis i/o productes oferts per LA INDUSTRIAL ALGODONERA, SA a través del seu Lloc Web; (ii) un mal funcionament del navegador; (iii) l’ús de versions no actualitzades del sistema.</p>
            <p><strong>&nbsp;</strong></p>
            <ol start="4">
            <li><strong> Enllaços a tercers</strong></li>
            </ol>
            <p>En aquest Lloc Web es poden utilitzar enllaços a altres pàgines web. LA INDUSTRIAL ALGODONERA, SA no es responsabilitza ni del contingut ni de les mesures de seguretat adoptades per qualsevol altra pàgina web a la qual es té accés des d’aquest Lloc Web, pàgines a les quals l’interessat accedeix sota la seva única responsabilitat.</p>
            <p>De la mateixa manera, tampoc es garanteix l’absència de virus o altres elements en els continguts enllaçats des del Lloc Web de LA INDUSTRIAL ALGODONERA, SA que puguin produir alteracions en el sistema informàtic (hardware i software) i/o en els documents o els fitxers de l’usuari, eximint igualment LA INDUSTRIAL ALGODONERA, SA de tota responsabilitat derivada dels danys de qualsevol tipus ocasionats per tot el que s’ha descrit anteriorment.</p>
            <p><strong>&nbsp;</strong></p>
            <ol start="5">
            <li><strong> Xarxes socials</strong></li>
            </ol>
            <p>L’informem que LA INDUSTRIAL ALGODONERA, SA pot estar present a les xarxes socials. El tractament de les dades que es dugui a terme de les persones que es facin seguidores a les xarxes socials (i/o realitzin qualsevol vincle o acció de connexió a través de les xarxes socials) de les pàgines oficials de LA INDUSTRIAL ALGODONERA, SA es regirà per aquest apartat, així com per aquelles condicions d’ús, polítiques de privacitat i normatives d’accés que pertanyin a la xarxa social que procedeixi en cada cas i acceptades prèviament per l’usuari.</p>
            <p>LA INDUSTRIAL ALGODONERA, SA tractarà les seves dades amb la finalitat d’administrar correctament la seva presència a la xarxa social, informant-lo d’activitats, productes o serveis de LA INDUSTRIAL ALGODONERA, SA, així com amb qualsevol altra finalitat que les normatives de les Xarxes Socials permetin.</p>
            <p>Queda prohibida la publicació de continguts:</p>
            <p>– Que siguin presumptament il·lícits per la normativa nacional, comunitària o internacional o que realitzin activitats presumptament il•lícites o contravinguin els principis de la bona fe.</p>
            <p>– Que atemptin contra els drets fonamentals de les persones, faltin a la cortesia a la xarxa, molestin o puguin generar opinions negatives als nostres usuaris o tercers i en general qualsevol contingut que LA INDUSTRIAL ALGODONERA, SA consideri no apropiats.</p>
            <p>– I en general que contravinguin els principis de legalitat, honorabilitat, responsabilitat, protecció de la dignitat humana, protecció de menors, protecció del ordre públic, la protecció de la vida privada, protecció del consumidor i els drets de propietat intel·lectual i industrial.</p>
            <p>Tanmateix, LA INDUSTRIAL ALGODONERA, SA es reserva la potestat de retirar, sense previ avís de la pàgina web o de la xarxa social corporativa aquells continguts que es considerin no apropiats.</p>
            <p><strong>&nbsp;</strong></p>
            <ol start="6">
            <li><strong> Modificació de l’Avís Legal, Política de Privacitat i de Protecció de Dades.</strong></li>
            </ol>
            <p>El Responsable del Lloc Web es reserva el dret a modificar en tot moment i sense avís previ les presents condicions, termes i polítiques de privacitat per adaptar-les a les novetats legislatives o jurisprudencials així com a les modificacions o pràctiques de la indústria, amb l’obligació, per part de l’usuari de consultar periòdicament aquestes condicions, termes i polítiques a fi i efecte de comprovar o assegurar-se de l’existència de canvis, prenent com a referència la data de l’última actualització.</p>
            ',
            'en' => '
            <ol>
            <li><strong> Corporate Information</strong></li>
            </ol>
            <p>Under the obligations stipulated by Regulation (EU) 2016/679 of the European Parliament and of the Council of 27 April 2016, we do inform you that this website is owned by LA INDUSTRIAL ALGODONERA, SA., with CIF number A43000132, and corporate domicile at C/Sant Rafael Nº 21, 43470, La Selva del Camp, Tarragona, Spain, and the following contact details: +34 977 844 000 / <a href="mailto:comercial@laindustrialalgodonera.com">comercial@laindustrialalgodonera.com</a>.</p>
            <p>This company has been registered: Registro Mercantil de Tarragona under the following registered information: Hoja Tarragona, Folio 128, Tomo 15, Libro de Sociedades. Sección General, CIF A43000132.</p>
            <p>&nbsp;</p>
            <ol start="2">
            <li><strong>Content Protection</strong></li>
            </ol>
            <p>The User acknowledges and agrees that all rights of intellectual property on the contents and/or any other elements inserted by <a href="https://www.laindustrialalgodonera.com/en/">LA INDUSTRIAL ALGODONERA, SA</a>. In this Website (including but not limited to, those elements that make up the visual appearance, graphic image and other sensorial incentives of the website or ‘look and feel’: trademarks, logos, trade names, texts, images, graphics, designs, sounds, databases, software, flow charts, presentation, navigation architecture as well as the source codes of web pages) belong to LA INDUSTRIAL ALGODONERA, SA. And/or third parties in favour of which have assigned their rights.</p>
            <p>In any case access to the Website imply any type of permit, waiver, license or total or partial transfer of such rights by their owners, unless otherwise expressly stated. These terms and conditions of use of the Website do not give Users any other right of use, modification, exploitation, reproduction, distribution or public communication of the Website and/or its contents other than those expressly provided herein.</p>
            <p>The use of such elements, its total or partial reproduction, communication and/or distribution for commercial purposes or financial gain as well as its modification, alteration, decompilation and/or any other act of exploitation of the Website, are strictly prohibited.</p>
            <p>Notwithstanding the foregoing, if the User or a third part considers that any content of the Website could infringe the rights of intellectual property, we would appreciate if you could please put in our knowledge as soon as possible.</p>
            <p><strong>&nbsp;</strong></p>
            <ol start="3">
            <li><strong> Accesses and Use of the Website</strong></li>
            </ol>
            <p>Both access to the Website and the non-consensual use, which may be made of the information contained therein, is the sole responsibility of the user.</p>
            <p>The user agrees to use the content, information and data from the Website in accordance with these conditions, terms and policies with applicable regulations and generally accepted good customs and public order.</p>
            <p>The user agrees to refrain from using the contents of the Website for any harmful illegal, prohibited or contrary purposes to those set forth herein, or any detrimental purpose on the rights and interests of LA INDUSTRIAL ALGODONERA, SA., other users, third parties or that in any way could damage, disable, overburden, or impair this website or prevent from its normal use or enjoyment thereof by users.</p>
            <p>LA INDUSTRIAL ALGODONERA, S.A. Shall not be responsible for any consequence or damage that may arise from such access or use or breach of these terms, conditions and policies nor be responsible for security errors that may occur or the damage caused to the user’s computer system (hardware and software) or to the files or documents stored therein as a result of: (I) the presence of a virus on the user’s computer that is used for connection to services and/or products offered by LA INDUSTRIAL ALGODONERA, SA. through its Website; (II) a malfunction of the browser; (III) the use of non-updated versions.</p>
            <p>&nbsp;</p>
            <ol start="4">
            <li><strong> Links to third parties</strong></li>
            </ol>
            <p>In this Website you can use links to other pages or websites. LA INDUSTRIAL ALGODONERA, SA. shall not be liable for the content or security measures adopted by any other page or website to which you may have access from this Website, sites accessed by the interested person under its own and sole responsibility.</p>
            <p>Furthermore, neither the absence of viruses or other elements in the linked contents from the Website of LA INDUSTRIAL ALGODONERA, SA. that may cause alterations in the computer system (hardware and software) and/or documents or files of the User is guaranteed, excluding in any case LA INDUSTRIAL ALGODONERA, SA. from any liability for damages of any kind that might be caused by the above mentioned situation.</p>
            <p>&nbsp;</p>
            <ol start="5">
            <li><strong> Social Networks</strong></li>
            </ol>
            <p>We do inform you that LA INDUSTRIAL ALGODONERA, SA. may be present on social networks. The processing of data from people being followers in social networks (and/or performing any link or connection through social networks) of official pages of LA INDUSTRIAL ALGODONERA, SA. shall be governed by this section, as well as by those terms of use, privacy policies and access rules pertaining to the social network as appropriate in each case and previously accepted by the user.</p>
            <p>LA INDUSTRIAL ALGODONERA, SA. shall process your data for the purposes of properly managing its presence on the social network, informing you on the activities, products or services of LA INDUSTRIAL ALGODONERA, SA. as well as for any other purpose that regulations on social networks may allow.</p>
            <p>The publishing of the following contents is prohibited:</p>
            <p>– Contents that may be allegedly illegal according to national, EU or international legislation or may conduct allegedly illegal activities or may contravene the principles of good faith.</p>
            <p>– Contents that may infringe the fundamental rights of individuals, skip courtesy in the network, disturb or may generate negative opinions in our users or third parties and in general whatever the content LA INDUSTRIAL ALGODONERA, SA. may deem inappropriate.</p>
            <p>– And in general contents that may contravene the principles of legality, honesty, responsibility, protection of human dignity, protection of minors, protection of public order, protection of privacy, consumer protection and intellectual and industrial property rights.</p>
            <p>Likewise, LA INDUSTRIAL ALGODONERA, SA. reserves the power to withdraw, without previous notice of the website or the corporate social network those contents that may be deemed inappropriate.</p>
            <p>&nbsp;</p>
            <ol start="6">
            <li><strong> Modification of Terms and Conditions of Use, Privacy Policy and Data Protection.</strong></li>
            </ol>
            <p>LA INDUSTRIAL ALGODONERA, SA reserves the right to change at any time without previous notice these terms, conditions and privacy policies in order to get them adapted to new legislation or jurisprudence as well as to amendments or industry practices, and the user must regularly consult these conditions, terms and policies in order to verify or ascertain the existence of any changes in them, taking by reference the date of the last update.</p>
            ',
            'fr' => '
            <ol>
            <li><strong> Corporate Information</strong></li>
            </ol>
            <p>Under the obligations stipulated by Regulation (EU) 2016/679 of the European Parliament and of the Council of 27 April 2016, we do inform you that this website is owned by LA INDUSTRIAL ALGODONERA, SA., with CIF number A43000132, and corporate domicile at C/Sant Rafael Nº 21, 43470, La Selva del Camp, Tarragona, Spain, and the following contact details: +34 977 844 000 / <a href="mailto:comercial@laindustrialalgodonera.com">comercial@laindustrialalgodonera.com</a>.</p>
            <p>This company has been registered: Registro Mercantil de Tarragona under the following registered information: Hoja Tarragona, Folio 128, Tomo 15, Libro de Sociedades. Sección General, CIF A43000132.</p>
            <p>&nbsp;</p>
            <ol start="2">
            <li><strong>Content Protection</strong></li>
            </ol>
            <p>The User acknowledges and agrees that all rights of intellectual property on the contents and/or any other elements inserted by <a href="https://www.laindustrialalgodonera.com/en/">LA INDUSTRIAL ALGODONERA, SA</a>. In this Website (including but not limited to, those elements that make up the visual appearance, graphic image and other sensorial incentives of the website or ‘look and feel’: trademarks, logos, trade names, texts, images, graphics, designs, sounds, databases, software, flow charts, presentation, navigation architecture as well as the source codes of web pages) belong to LA INDUSTRIAL ALGODONERA, SA. And/or third parties in favour of which have assigned their rights.</p>
            <p>In any case access to the Website imply any type of permit, waiver, license or total or partial transfer of such rights by their owners, unless otherwise expressly stated. These terms and conditions of use of the Website do not give Users any other right of use, modification, exploitation, reproduction, distribution or public communication of the Website and/or its contents other than those expressly provided herein.</p>
            <p>The use of such elements, its total or partial reproduction, communication and/or distribution for commercial purposes or financial gain as well as its modification, alteration, decompilation and/or any other act of exploitation of the Website, are strictly prohibited.</p>
            <p>Notwithstanding the foregoing, if the User or a third part considers that any content of the Website could infringe the rights of intellectual property, we would appreciate if you could please put in our knowledge as soon as possible.</p>
            <p><strong>&nbsp;</strong></p>
            <ol start="3">
            <li><strong> Accesses and Use of the Website</strong></li>
            </ol>
            <p>Both access to the Website and the non-consensual use, which may be made of the information contained therein, is the sole responsibility of the user.</p>
            <p>The user agrees to use the content, information and data from the Website in accordance with these conditions, terms and policies with applicable regulations and generally accepted good customs and public order.</p>
            <p>The user agrees to refrain from using the contents of the Website for any harmful illegal, prohibited or contrary purposes to those set forth herein, or any detrimental purpose on the rights and interests of LA INDUSTRIAL ALGODONERA, SA., other users, third parties or that in any way could damage, disable, overburden, or impair this website or prevent from its normal use or enjoyment thereof by users.</p>
            <p>LA INDUSTRIAL ALGODONERA, S.A. Shall not be responsible for any consequence or damage that may arise from such access or use or breach of these terms, conditions and policies nor be responsible for security errors that may occur or the damage caused to the user’s computer system (hardware and software) or to the files or documents stored therein as a result of: (I) the presence of a virus on the user’s computer that is used for connection to services and/or products offered by LA INDUSTRIAL ALGODONERA, SA. through its Website; (II) a malfunction of the browser; (III) the use of non-updated versions.</p>
            <p>&nbsp;</p>
            <ol start="4">
            <li><strong> Links to third parties</strong></li>
            </ol>
            <p>In this Website you can use links to other pages or websites. LA INDUSTRIAL ALGODONERA, SA. shall not be liable for the content or security measures adopted by any other page or website to which you may have access from this Website, sites accessed by the interested person under its own and sole responsibility.</p>
            <p>Furthermore, neither the absence of viruses or other elements in the linked contents from the Website of LA INDUSTRIAL ALGODONERA, SA. that may cause alterations in the computer system (hardware and software) and/or documents or files of the User is guaranteed, excluding in any case LA INDUSTRIAL ALGODONERA, SA. from any liability for damages of any kind that might be caused by the above mentioned situation.</p>
            <p>&nbsp;</p>
            <ol start="5">
            <li><strong> Social Networks</strong></li>
            </ol>
            <p>We do inform you that LA INDUSTRIAL ALGODONERA, SA. may be present on social networks. The processing of data from people being followers in social networks (and/or performing any link or connection through social networks) of official pages of LA INDUSTRIAL ALGODONERA, SA. shall be governed by this section, as well as by those terms of use, privacy policies and access rules pertaining to the social network as appropriate in each case and previously accepted by the user.</p>
            <p>LA INDUSTRIAL ALGODONERA, SA. shall process your data for the purposes of properly managing its presence on the social network, informing you on the activities, products or services of LA INDUSTRIAL ALGODONERA, SA. as well as for any other purpose that regulations on social networks may allow.</p>
            <p>The publishing of the following contents is prohibited:</p>
            <p>– Contents that may be allegedly illegal according to national, EU or international legislation or may conduct allegedly illegal activities or may contravene the principles of good faith.</p>
            <p>– Contents that may infringe the fundamental rights of individuals, skip courtesy in the network, disturb or may generate negative opinions in our users or third parties and in general whatever the content LA INDUSTRIAL ALGODONERA, SA. may deem inappropriate.</p>
            <p>– And in general contents that may contravene the principles of legality, honesty, responsibility, protection of human dignity, protection of minors, protection of public order, protection of privacy, consumer protection and intellectual and industrial property rights.</p>
            <p>Likewise, LA INDUSTRIAL ALGODONERA, SA. reserves the power to withdraw, without previous notice of the website or the corporate social network those contents that may be deemed inappropriate.</p>
            <p>&nbsp;</p>
            <ol start="6">
            <li><strong> Modification of Terms and Conditions of Use, Privacy Policy and Data Protection.</strong></li>
            </ol>
            <p>LA INDUSTRIAL ALGODONERA, SA reserves the right to change at any time without previous notice these terms, conditions and privacy policies in order to get them adapted to new legislation or jurisprudence as well as to amendments or industry practices, and the user must regularly consult these conditions, terms and policies in order to verify or ascertain the existence of any changes in them, taking by reference the date of the last update.</p>
            ',
            'it' => '
            <ol>
            <li><strong> Corporate Information</strong></li>
            </ol>
            <p>Under the obligations stipulated by Regulation (EU) 2016/679 of the European Parliament and of the Council of 27 April 2016, we do inform you that this website is owned by LA INDUSTRIAL ALGODONERA, SA., with CIF number A43000132, and corporate domicile at C/Sant Rafael Nº 21, 43470, La Selva del Camp, Tarragona, Spain, and the following contact details: +34 977 844 000 / <a href="mailto:comercial@laindustrialalgodonera.com">comercial@laindustrialalgodonera.com</a>.</p>
            <p>This company has been registered: Registro Mercantil de Tarragona under the following registered information: Hoja Tarragona, Folio 128, Tomo 15, Libro de Sociedades. Sección General, CIF A43000132.</p>
            <p>&nbsp;</p>
            <ol start="2">
            <li><strong>Content Protection</strong></li>
            </ol>
            <p>The User acknowledges and agrees that all rights of intellectual property on the contents and/or any other elements inserted by <a href="https://www.laindustrialalgodonera.com/en/">LA INDUSTRIAL ALGODONERA, SA</a>. In this Website (including but not limited to, those elements that make up the visual appearance, graphic image and other sensorial incentives of the website or ‘look and feel’: trademarks, logos, trade names, texts, images, graphics, designs, sounds, databases, software, flow charts, presentation, navigation architecture as well as the source codes of web pages) belong to LA INDUSTRIAL ALGODONERA, SA. And/or third parties in favour of which have assigned their rights.</p>
            <p>In any case access to the Website imply any type of permit, waiver, license or total or partial transfer of such rights by their owners, unless otherwise expressly stated. These terms and conditions of use of the Website do not give Users any other right of use, modification, exploitation, reproduction, distribution or public communication of the Website and/or its contents other than those expressly provided herein.</p>
            <p>The use of such elements, its total or partial reproduction, communication and/or distribution for commercial purposes or financial gain as well as its modification, alteration, decompilation and/or any other act of exploitation of the Website, are strictly prohibited.</p>
            <p>Notwithstanding the foregoing, if the User or a third part considers that any content of the Website could infringe the rights of intellectual property, we would appreciate if you could please put in our knowledge as soon as possible.</p>
            <p><strong>&nbsp;</strong></p>
            <ol start="3">
            <li><strong> Accesses and Use of the Website</strong></li>
            </ol>
            <p>Both access to the Website and the non-consensual use, which may be made of the information contained therein, is the sole responsibility of the user.</p>
            <p>The user agrees to use the content, information and data from the Website in accordance with these conditions, terms and policies with applicable regulations and generally accepted good customs and public order.</p>
            <p>The user agrees to refrain from using the contents of the Website for any harmful illegal, prohibited or contrary purposes to those set forth herein, or any detrimental purpose on the rights and interests of LA INDUSTRIAL ALGODONERA, SA., other users, third parties or that in any way could damage, disable, overburden, or impair this website or prevent from its normal use or enjoyment thereof by users.</p>
            <p>LA INDUSTRIAL ALGODONERA, S.A. Shall not be responsible for any consequence or damage that may arise from such access or use or breach of these terms, conditions and policies nor be responsible for security errors that may occur or the damage caused to the user’s computer system (hardware and software) or to the files or documents stored therein as a result of: (I) the presence of a virus on the user’s computer that is used for connection to services and/or products offered by LA INDUSTRIAL ALGODONERA, SA. through its Website; (II) a malfunction of the browser; (III) the use of non-updated versions.</p>
            <p>&nbsp;</p>
            <ol start="4">
            <li><strong> Links to third parties</strong></li>
            </ol>
            <p>In this Website you can use links to other pages or websites. LA INDUSTRIAL ALGODONERA, SA. shall not be liable for the content or security measures adopted by any other page or website to which you may have access from this Website, sites accessed by the interested person under its own and sole responsibility.</p>
            <p>Furthermore, neither the absence of viruses or other elements in the linked contents from the Website of LA INDUSTRIAL ALGODONERA, SA. that may cause alterations in the computer system (hardware and software) and/or documents or files of the User is guaranteed, excluding in any case LA INDUSTRIAL ALGODONERA, SA. from any liability for damages of any kind that might be caused by the above mentioned situation.</p>
            <p>&nbsp;</p>
            <ol start="5">
            <li><strong> Social Networks</strong></li>
            </ol>
            <p>We do inform you that LA INDUSTRIAL ALGODONERA, SA. may be present on social networks. The processing of data from people being followers in social networks (and/or performing any link or connection through social networks) of official pages of LA INDUSTRIAL ALGODONERA, SA. shall be governed by this section, as well as by those terms of use, privacy policies and access rules pertaining to the social network as appropriate in each case and previously accepted by the user.</p>
            <p>LA INDUSTRIAL ALGODONERA, SA. shall process your data for the purposes of properly managing its presence on the social network, informing you on the activities, products or services of LA INDUSTRIAL ALGODONERA, SA. as well as for any other purpose that regulations on social networks may allow.</p>
            <p>The publishing of the following contents is prohibited:</p>
            <p>– Contents that may be allegedly illegal according to national, EU or international legislation or may conduct allegedly illegal activities or may contravene the principles of good faith.</p>
            <p>– Contents that may infringe the fundamental rights of individuals, skip courtesy in the network, disturb or may generate negative opinions in our users or third parties and in general whatever the content LA INDUSTRIAL ALGODONERA, SA. may deem inappropriate.</p>
            <p>– And in general contents that may contravene the principles of legality, honesty, responsibility, protection of human dignity, protection of minors, protection of public order, protection of privacy, consumer protection and intellectual and industrial property rights.</p>
            <p>Likewise, LA INDUSTRIAL ALGODONERA, SA. reserves the power to withdraw, without previous notice of the website or the corporate social network those contents that may be deemed inappropriate.</p>
            <p>&nbsp;</p>
            <ol start="6">
            <li><strong> Modification of Terms and Conditions of Use, Privacy Policy and Data Protection.</strong></li>
            </ol>
            <p>LA INDUSTRIAL ALGODONERA, SA reserves the right to change at any time without previous notice these terms, conditions and privacy policies in order to get them adapted to new legislation or jurisprudence as well as to amendments or industry practices, and the user must regularly consult these conditions, terms and policies in order to verify or ascertain the existence of any changes in them, taking by reference the date of the last update.</p>
            ',
        ];

        LanguageLine::create([
            'group' => 'Politicas',
            'key' => 'texto_aviso_legal',
            'text' => $textos
        ]);
    }
}