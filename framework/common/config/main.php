<?php
return [
    'name' => 'Garden Keeper',
    'language' => 'en',
    'layout' => '@common/views/layouts/main.tpl',
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'enableStrictParsing' => false,
            'rules' => [
                '/' => '/site/index',
                '/login' => '/site/login',
                '/logout' => '/site/logout',
                '/signup' => '/site/signup',
            ]
        ],
        'view' => [
            'renderers' => [
                'tpl' => [
                    'class' => 'yii\smarty\ViewRenderer',
                    //'cachePath' => '@runtime/Smarty/cache',
                    'widgets' => [
                        'blocks' => [
                            'ActiveForm' => '\yii\widgets\ActiveForm'
                        ]
                    ]
                ]
            ]
        ]
    ],
];
