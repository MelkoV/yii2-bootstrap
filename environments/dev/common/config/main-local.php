<?php
return [
    'components' => [
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'pgsql:host=localhost;dbname=yii2',
            'username' => 'yii2',
            'password' => 'yii2',
            'charset' => 'utf8',
            'enableSchemaCache' => false,
            'schemaCacheDuration' => 3600,
            'attributes' => [
                PDO::ATTR_PERSISTENT => true
            ],
            'enableLogging' => true,
            'enableProfiling' => true
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'viewPath' => '@common/mail',
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => 'smtp.yandex.ru',
                'username' => 'noreply@localhost',
                'password' => 'yii2',
                'port' => '465',
                'encryption' => 'SSL',
            ],

        ],
        'log' => [
            'targets' => [
                [
//                    'traceLevel' => YII_DEBUG ? 3 : 0,
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
                [
                    'class' => 'yii\log\EmailTarget',
                    'levels' => ['error', 'warning'],
//                    'categories' => ['yii\db\*'],
                    "except" => ['yii\web*'],
                    'message' => [
                        'from' => ['noreply@localhost'],
                        'to' => ['me@localhost'],
                        'subject' => 'ERROR on localhost',
                    ],
                ],
            ],
        ],

    ],
];
