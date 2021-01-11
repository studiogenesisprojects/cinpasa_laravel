<?php

return [
    'redirects' => [
        'index' => 'serie',
        'show' => 'serie/{slug}',
        'applications' => 'aplicacio/{slug}',
        'pcategories' => 'producte/{slug}'
    ],
    'products' => [
        'index' => 'productes',
        'show' => 'productes/{productCategory}',
        'showProduct' => 'productes/{productCategory}/{product}',
        'showProductRe' => 'productes/re/{product}',
        'searchProducts' => 'productes/busqueda/filtre',

    ],
    'distribute' => [
        'index' => 'distribuir',
    ],
    'applications' => [
        "index" => 'aplicacions',
        "show" => 'aplicacions/{applicationCategory}',
        "_show" => 'aplicacions/{applicationCategory}/{aplication}',
    ],
    'company' => [
        'index' => 'empresa',
        '100_block' => 'bloc-100',
    ],
    'ecology' => [
        'index' => 'ecologia',
    ],
    'politic_pages' => [
        'leagal_warning' => 'avis-legal',
        'politic_privacy' => 'politica-de-privacitat',
        'coockie_privacy' => 'politica-de-cookies',
    ],
    'contact' => [
        'index' => 'contacte',
        'store' => 'contacte/formulari-de-contacte',
        'storeWithoutOffer' => 'contacte/sense-oferta/formulari-de-contacte',
        'stored' => 'contacte/formulari-de-contacte/enviat',
    ],
    'colors' => [
        'index' => 'colors',
        'show' => 'colors/{productCategoryColor}',
        'ajax' => 'colors/ajax/{id}',
    ],
    'materials' => [
        'index' => 'materials',
        'show' => 'materials/{material}',
    ],
    'endings' => [
        'index' => 'acabats',
        'show' => 'acabats/{finished}',
    ],
    'news' => [
        'index' => 'noticies',
        'show' => 'noticies/{news}',
        'tags' => 'noticies/etiquetes/{newsTag}',
        'categories' => 'noticies/categories/{newsCategory}'
    ],
    'favorites' => [
        'index' => 'favorits',
        'info' => 'favorits/informacio',
        'stored' => 'favorits/peticio_realitzada',
    ],
    'work-with-us' => [
        'index' => 'treballa-amb-nosaltres',
        'store' => 'treballa-amb-nosaltres/cv/envian',
        'stored' => 'treballa-amb-nosaltres/cv/enviat',
        'show' => 'treballa-amb-nosaltres/{jobOffer}',
    ],
    'outlet' => [
        'index' => 'outlet',
        'show' => 'outlet/{product}',
    ],
    'lab' => [
        'index' => 'lab',
        'show_products' => 'lab/{slug}'
    ]

];
