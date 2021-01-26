<?php

use App\Localization\laravellocalization\src\Mcamara\LaravelLocalization\Facades\LaravelLocalization;

return [
    'bannerText'        => "Le site Web utilise ses propres cookies et ceux de tiers à des fins analytiques et techniques pour améliorer l'expérience de navigation. Vous pouvez tous les accepter ou modifier vos préférences en matière de cookies dans le bouton Paramètres. Plus d'informations dans ",
    'bannerLinkText'    => 'Politique relative aux cookies.',
    'bannerLink'        => LaravelLocalization::getURLFromRouteNameTranslated(App::getLocale(),'routes.politic_pages.coockie_privacy'),
    'buttonOk'          => 'Accepter les cookies',
    'buttonKo'          => 'Nier',
    'buttonConfig'      => 'Configuration',
    'lastRevision'      => 'Dernière révision:',

    'acceptAllButton'   => 'Accepter tout',
    'save'              => 'Sauver',
    'PopupTitle'        => 'Votre vie privée est importante pour nous',
    'PopupDescription'  => 'Les cookies sont de très petits fichiers texte qui sont stockés sur votre ordinateur lorsque vous visitez un site Web. Nous utilisons des cookies à diverses fins et pour améliorer votre expérience en ligne sur notre site Web (par exemple, pour mémoriser les informations de connexion de votre compte).',
    'PopupDescription2' => "Vous pouvez modifier vos préférences et refuser certains types de cookies à stocker sur votre ordinateur lorsque vous naviguez sur notre site Web. Vous pouvez également supprimer tous les cookies déjà stockés sur votre ordinateur, mais gardez à l'esprit que la suppression des cookies peut vous empêcher d'utiliser certaines parties de notre site Web.",

    /* Cookies esenciales */
    'essential'             => 'Cookies strictement nécessaires',
    'essential_description' => "Ces cookies sont essentiels pour vous permettre de vous déplacer sur le site et d'utiliser ses fonctions. Sans ces cookies, les services que vous avez demandés ne peuvent pas être fournis.",

    'cookie_consent'        => '<strong> Cookie de consentement: </strong> Informations nécessaires pour enregistrer les préférences pour ces paramètres.',
    'session'               => '<strong> Cookie de session: </strong> le langage de programmation pour le développement Web utilise un cookie pour identifier les sessions des utilisateurs.',
    'xsrf-token'            => "<strong> XSRF-Token cookie: </strong> Le framework utilisé génère automatiquement un token CSRF pour chaque session utilisateur active, il est utilisé pour vérifier que l'utilisateur est celui qui fait les demandes de formulaire depuis le web.",

    /* Cookies analíticas */
    'analytics'             => 'Analytique',
    'analytics_description' => "Ils permettent de connaître le comportement et l'activité des utilisateurs sur le site Web pour l'élaboration des profils de navigation de ses utilisateurs afin de s'améliorer en fonction de l'analyse des données d'utilisation faites par les utilisateurs du service.",

    '_ga'   => '<strong> Cookie Google Analytics: </strong> ouvre un identifiant unique utilisé pour générer des statistiques sur la manière dont le visiteur utilise le site Web.',

];
