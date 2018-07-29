<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    "language" => "ru-RU",
    'timeZone' => 'Europe/Moscow',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'class' => 'yii\web\User',
            'enableAutoLogin' => true,
        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
            'defaultRoles' => ['guest', 'user'],
        ],
        'i18n' => [
            'translations' => [
                '*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@common/messages'
                ],
            ],
        ],
        /*'i18n' => [
            'translations' => [
                '*' => [
                    'class' => 'yii\i18n\DbMessageSource',
                    'db' => 'db',
                    'sourceLanguage' => 'en-US',
                    'sourceMessageTable' => 'language_source',
                    'messageTable' => 'language_translate',
                    'cachingDuration' => 86400,
                    'enableCaching' => true,
                ],
            ],
        ],*/
		'log' => [
            'targets' => [
                [
//                    'traceLevel' => YII_DEBUG ? 3 : 0,
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
                [
                    'class' => 'yii\log\EmailTarget',
                    'levels' => ['error'],
//                    'categories' => ['yii\db\*'],
                    "except" => ['yii\web*'],
                    'message' => [
                        'from' => ['robot@example.com'],
                        'to' => ['me@example.com'],
                        'subject' => 'ERROR on example.com',
                    ],
                ],
            ],
        ],
    ],
];
