<?php

return [
    'redirects' => [
        'index' => 'serie',
        'show' => 'serie/{slug}',
        'applications' => 'aplication/{slug}',
        'pcategories' => 'product/{slug}'
    ],
    'products' => [
        'index' => 'products',
        'show' => 'products/{productCategory}',
        'showProduct' => 'products/{productCategory}/{product}',
        //esta ruta se utiliza para redireccionar de /product/p a /producto/cat/p
        'showProductRe' => 'products/re/{product}',
        'searchProducts' => 'products/search/filter',
    ],
    'applications' => [
        "index" => 'applications',
        "show" => 'applications/{applicationCategory}',
        "_show" => 'applications/{applicationCategory}/{aplication}',
    ],
    'company' => [
        'index' => 'enterprise',
        '100_block' => 'block-100',
    ],
    'ecology' => [
        'index' => 'ecology',
    ],
    'politic_pages' => [
        'leagal_warning' => 'legal-warning',
        'politic_privacy' => 'privacy-policy',
        'coockie_privacy' => 'cookie-policy',
    ],
    'contact' => [
        'index' => 'contact',
        'store' => 'contact/contact-form',
        'storeWithoutOffer' => 'contact/without-offer/contact-form',
        'stored' => 'contact/contact-form/send',
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
        'index' => 'endings',
        'show' => 'endings/{finished}',
        'old_web' => 'ending/{finished}',
    ],
    'news' => [
        'index' => 'news',
        'show' => 'news/{news}',
        'tags' => 'news/tags/{newsTag}',
        'categories' => 'news/categories/{newsCategory}'
    ],
    'favorites' => [
        'index' => 'favourite',
        'info' => 'favourite/info',
        'stored' => 'favourite/petition_ok',
    ],
    'work-with-us' => [
        'index' => 'work-with-us',
        'store' => 'work-with-us/cv/sending',
        'stored' => 'work-with-us/cv/sended',
        'show' => 'work-with-us/{jobOffer}',
    ],
    'outlet' => [
        'index' => 'outlet'
    ],
    'lab' => [
        'index' => 'lab'
    ]
];
