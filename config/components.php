<?php
//组件
return [
    'request' => [
        // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
        'cookieValidationKey' => '7qomB1VNo9vXHtyUCPvhXdkBAjg2Rvnt',
    ],
    'cache' => [
        'class' => 'yii\caching\FileCache',
    ],
    'user' => [
        'identityClass' => 'app\models\User',
        'enableAutoLogin' => true,
    ],
    'session' => [
        // this is the name of the session cookie used for login
        'name' => 'jayden-ok',
    ],
    'errorHandler' => [
        'errorAction' => 'site/error',
    ],
    'mailer' => [
        'class' => 'yii\swiftmailer\Mailer',
        // send all mails to a file by default. You have to set
        // 'useFileTransport' to false and configure transport
        // for the mailer to send real emails.
        'useFileTransport' => true,
    ],
    'log' => [
        'traceLevel' => YII_DEBUG ? 3 : 0,
        'targets' => [
            [
                'class' => 'yii\log\FileTarget',
                'levels' => ['error', 'warning'],
            ],
        ],
    ],
    'urlManager' => [
        //开启美化url
        'enablePrettyUrl' => true,
        //是否显示脚本名称index.php
        'showScriptName' => false,
        //是否开启严格解析(按rules规则)
        'enableStrictParsing' => false,
        'rules' => [
        ],
    ],
    'i18n' => [
        'translations' => [
            'code/*' => [
                'class' => 'yii\i18n\PhpMessageSource',
                'basePath' => '@app/modules/common/core',
            ],
        ]
    ],
];
