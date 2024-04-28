<?php

$params = require __DIR__ . '/params.php';
$modules = require __DIR__ . '/modules.php';

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm' => '@vendor/npm-asset',
    ],
    //应用默认路由，控制器里可配置默认action动作方法
    'defaultRoute' => 'home/home/login',
    //引入多数据库连接对象
    'components' => array_merge(
        require __DIR__ . '/db.php',
        require __DIR__ . '/components.php'
    ),
    //常量定义
    'params' => $params,
    //多功能模块
    'modules' => $modules,
];


if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}

return $config;
