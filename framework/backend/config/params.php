<?php
return [
    'adminEmail' => 'admin@example.com',
    'nav'   => [
        'user' => [
            '_menu' => [
                'label'     => 'Users',
                'url'       => '/user'
            ],
//           '_access' => 'user.index'
        ],
        'land'  => [
            '_menu' => [
                'label'     => 'Lands',
                'url'       => '/land'
            ],
//           '_access' => 'land.index'
        ],
        'garden' => [
            '_menu' => [
                'label'     => 'Garden',
                'url'       => '/garden'
            ],
//           '_access' => 'garden.index'
        ],
        'gather' => [
            '_menu' => [
                'label'     => 'Gather',
                'url'       => '/gather'
            ],
//           '_access' => 'gather.index'
        ],
        'encyclopedia' => [
            '_menu' => [
                'label'     => 'Encyclopedia',
            ],
//           '_access' => 'season.index'
            'season' => [
                '_menu' => [
                    'label'     => 'Seasons',
                    'url'       => '/season'
                ],
//           '_access' => 'season.index'
            ],
            'climate' => [
                '_menu' => [
                    'label'     => 'Climates',
                    'url'       => '/climate'
                ],
//           '_access' => 'climate.index'
            ],
            'weather' => [
                '_menu' => [
                    'label'     => 'Weather',
                    'url'       => '/weather'
                ],
//           '_access' => 'weather.index'
            ],
            '_divider'  => true,
            'plant' => [
                '_menu' => [
                    'label'     => 'Plants',
                    'url'       => '/plant'
                ],
//           '_access' => 'plant.index'
            ],
            'product' => [
                '_menu' => [
                    'label'     => 'Products',
                    'url'       => '/product'
                ],
//           '_access' => 'product.index'
            ],
        ],
    ],
];
