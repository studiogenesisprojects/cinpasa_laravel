<?php

return [
    'redirects' => [
        'index' => 'Индекс',
        'show' => 'показать/{slug}',
        'applications' => 'приложения/{slug}',
        'pcategories' => 'категории/{slug}'
    ],
    'products' => [
        'index' => 'Индекс',
        'show' => 'показать/{productCategory}',
        'showProduct' => 'показать/{productCategory}/{product}',
        'showProductRe' => 'показать/re/{product}',
        'searchProducts' => 'показать/ricerca/filtro'
    ],
    'applications' => [
        "index" => 'приложения',
        "show" => 'приложения/{applicationCategory}',
        "_show" => 'приложения/{applicationCategory}/{aplication}',
    ],
    'distribute' => [
        'index' => 'раздавать',
    ],
    'company' => [
        'index' => 'компания',
        '100_block' => 'blocco-100',
    ],
    'ecology' => [
        'index' => 'экология',
    ],
    'politic_pages' => [
        'leagal_warning' => 'правовое-предупреждение',
        'politic_privacy' => 'политика-приватность',
        'coockie_privacy' => 'секретность-cookie-файлов',
    ],
    'contact' => [
        'index' => 'контактный-адрес',
        'store' => 'контактный адрес/контрактный-модуль',
        'storeWithoutOffer' => 'контактный-адрес/senza-offerta/контрактный-модуль',
        'stored' => 'контактный-адрес/контрактный-модуль/отправленный',
    ],
    'colors' => [
        'index' => 'цвета',
        'show' => 'цвета/{productCategoryColor}',
        'ajax' => 'цвета/аякс/{id}',
    ],
    'materials' => [
        'index' => 'материалы',
        'show' => 'материалы/{material}',
    ],
    'endings' => [
        'index' => 'терминалы',
        'show' => 'терминалы/{finished}',
    ],
    'news' => [
        'index' => 'новости',
        'show' => 'новости/{news}',
        'tags' => 'новости/лейблы/{newsTag}',
        'categories' => 'новости/категории/{newsCategory}'
    ],
    'favorites' => [
        'index' => 'избранное',
        'info' => 'избранное/информация',
        'stored' => 'избранное/заявка-на-подачу',
    ],
    'work-with-us' => [
        'index' => 'работать-с-нами',
        'store' => 'работать-с-нами/cv/invio',
        'stored' => 'работать-с-нами/cv/inviato',
        'show' => 'работать-с-нами/{jobOffer}',
    ],
    'outlet' => [
        'index' => 'выход'
    ],
    'lab' => [
        'index' => 'лаборатория'
    ]
];
