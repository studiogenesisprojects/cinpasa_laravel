<?php

return [
    'redirects' => [
        'index' => 'serie',
        'show' => 'serie/{slug}',
        'applications' => 'applicazione/{slug}',
        'pcategories' => 'prodotto/{slug}'
    ],
    'products' => [
        'index' => 'prodotti',
        'show' => 'prodotti/{productCategory}',
        'showProduct' => 'prodotti/{productCategory}/{product}',
        'showProductRe' => 'prodotti/re/{product}',
        'searchProducts' => 'prodotti/ricerca/filtro'
    ],
    'applications' => [
        "index" => 'applicazioni',
        "show" => 'applicazioni/{applicationCategory}',
        "_show" => 'applicazioni/{applicationCategory}/{aplication}',
    ],
    'company' => [
        'index' => 'impresa',
        '100_block' => 'blocco-100',
    ],
    'ecology' => [
        'index' => 'ecologia',
    ],
    'politic_pages' => [
        'leagal_warning' => 'disclaimer-legale',
        'politic_privacy' => 'politica-di-privatizzazione',
        'coockie_privacy' => 'politica-dei-cookie',
    ],
    'contact' => [
        'index' => 'contatto',
        'store' => 'contatto/fmodulo-di-contatto',
        'storeWithoutOffer' => 'contatto/senza-offerta/fmodulo-di-contatto',
        'stored' => 'contatto/fmodulo-di-contatto/inviato',
    ],
    'colors' => [
        'index' => 'colori',
        'show' => 'colori/{productCategoryColor}',
        'ajax' => 'colori/ajax/{id}',
    ],
    'materials' => [
        'index' => 'materiali',
        'show' => 'materiali/{material}',
    ],
    'endings' => [
        'index' => 'terminali',
        'show' => 'terminali/{finished}',
    ],
    'news' => [
        'index' => 'notizie',
        'show' => 'notizie/{news}',
        'tags' => 'notizie/etichette/{newsTag}',
        'categories' => 'notizie/categorie/{newsCategory}'
    ],
    'favorites' => [
        'index' => 'favoriti',
        'info' => 'favoriti/informazioni',
        'stored' => 'favoriti/richiesta_presentata',
    ],
    'work-with-us' => [
        'index' => 'lavorare-con-noi',
        'store' => 'lavorare-con-noi/cv/invio',
        'stored' => 'lavorare-con-noi/cv/inviato',
        'show' => 'lavorare-con-noi/{jobOffer}',
    ],
];
