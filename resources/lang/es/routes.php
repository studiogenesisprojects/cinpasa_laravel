<?php
return [
    'redirects' => [
        'index' => 'serie',
        'show' => 'serie/{slug}',
        'applications' => 'aplicacion/{slug}',
        'pcategories' => 'producto/{slug}'
    ],
    'products' => [
        'index' => 'productos',
        'show' => 'productos/{productCategory}',
        'showProduct' => 'productos/{productCategory}/{product}',
        'showProductRe' => 'productos/re/{product}',
        'searchProducts' => 'productos/busqueda/filtro',
    ],
    'applications' => [
        "index" => 'aplicaciones',
        "show" => 'aplicaciones/{applicationCategory}',
        "_show" => 'aplicaciones/{applicationCategory}/{aplication}',
    ],
    'company' => [
        'index' => 'empresa',
        '100_block' => 'bloque-100',
    ],
    'ecology' => [
        'index' => 'ecologia',
    ],
    'politic_pages' => [
        'leagal_warning' => 'aviso-legal',
        'politic_privacy' => 'politica-privacidad',
        'coockie_privacy' => 'politica-de-cookies',
    ],
    'distribute' => [
        'index' => 'distribuir',
    ],
    'contact' => [
        'index' => 'contacto',
        'store' => 'contacto/formulario-de-contacto',
        'storeWithoutOffer' => 'contacto/sin-offerta/formulario-de-contacto',
        'stored' => 'contacto/formulario-de-contacto/enviado',
    ],
    'colors' => [
        'index' => 'colores',
        'show' => 'colores/{productCategoryColor}',
        'ajax' => 'colores/ajax/{id}',
    ],
    'materials' => [
        'index' => 'materiales',
        'show' => 'materiales/{material}',
    ],
    'endings' => [
        'index' => 'acabados',
        'show' => 'acabados/{finished}',
    ],
    'news' => [
        'index' => 'noticias',
        'show' => 'noticias/{news}',
        'tags' => 'noticias/etiquetas/{newsTag}',
        'categories' => 'noticias/categorias/{newsCategory}'
    ],
    'favorites' => [
        'index' => 'favoritos',
        'info' => 'favoritos/informacion',
        'stored' => 'favoritos/peticion_realizada',
    ],
    'work-with-us' => [
        'index' => 'trabaja-con-nosotros',
        'store' => 'trabaja-con-nosotros/cv/enviando',
        'stored' => 'trabaja-con-nosotros/cv/enviado',
        'show' => 'trabaja-con-nosotros/{jobOffer}',
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
