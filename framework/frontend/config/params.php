<?php
return [
    'adminEmail' => 'admin@gardenkeeper.com',
    'nav'   => [
        'plants' => [
            '_menu' => [
                'label'     => 'Plants',
                'url'       => '/plants'
            ],
            '_access' => '@'
        ],
        'growing' => [
            '_menu' => [
                'label'     => 'Growing',
                'url'       => '/growing'
            ],
            '_access' => '@'
        ],
        'stock' => [
            '_menu' => [
                'label'     => 'Stock',
                'url'       => '/stock'
            ],
            '_access' => '@'
        ],
        'about'  => [
            '_menu' => [
                'label'     => 'About',
                'url'       => '/site/about'
            ],
           '_access' => '?'
        ],
        'contact' => [
            '_menu' => [
                'label'     => 'Contact',
                'url'       => '/site/contact'
            ],
            '_access' => '?'
        ],
    ],
];
