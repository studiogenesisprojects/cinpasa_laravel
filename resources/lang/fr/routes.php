<?php

return [
    'redirects' => [
        'index' => 'serie',
        'show' => 'serie/{slug}',
        'applications' => 'application/{slug}',
        'pcategories' => 'produit/{slug}'
    ],
    'products' => [
        'index' => 'produits',
        'show' => 'produits/{productCategory}',
        'showProduct' => 'produits/{productCategory}/{product}',
        'showProductRe' => 'produits/re/{product}',
        'searchProducts' => 'produits/recherche/filtre'
    ],
    'applications' => [
        "index" => 'candidatures',
        "show" => 'candidatures/{applicationCategory}',
        "_show" => 'candidatures/{applicationCategory}/{aplication}',
    ],
    'distribute' => [
        'index' => 'distribuer',
    ],
    'company' => [
        'index' => 'entreprise',
        '100_block' => 'bloc-100',
    ],
    'ecology' => [
        'index' => 'ecologie',
    ],
    'politic_pages' => [
        'leagal_warning' => 'avertissement-legal',
        'politic_privacy' => 'politique-de-confidentialite',
        'coockie_privacy' => 'politique-des-cookies',
    ],
    'contact' => [
        'index' => 'contacter',
        'store' => 'contacter/formulaire-de-contact',
        'storeWithoutOffer' => 'contacter/sans-offre/formulaire-de-contact',
        'stored' => 'contacter/formulaire-de-contact/messager',
    ],
    'colors' => [
        'index' => 'couleurs',
        'show' => 'couleurs/{productCategoryColor}',
        'ajax' => 'couleurs/ajax/{id}',
    ],
    'materials' => [
        'index' => 'materiels',
        'show' => 'materiels/{material}',
    ],
    'endings' => [
        'index' => 'finitions',
        'show' => 'finitions/{finished}',
    ],
    'news' => [
        'index' => 'nouvelles',
        'show' => 'nouvelles/{news}',
        'tags' => 'nouvelles/etiquettes/{newsTag}',
        'categories' => 'nouvelles/categories/{newsCategory}'
    ],
    'favorites' => [
        'index' => 'favori',
        'info' => 'favori/information',
        'stored' => 'favori/demande_adressee',
    ],
    'work-with-us' => [
        'index' => 'travaillez-avec-nous',
        'store' => 'travaillez-avec-nous/cv/transmission',
        'stored' => 'travaillez-avec-nous/cv/messager',
        'show' => 'travaillez-avec-nous/{jobOffer}',
    ],
    'outlet' => [
        'index' => 'outlet'
    ],
    'lab' => [
        'index' => 'lab'
    ]
];
