<?php

// comment out the following two lines when deployed to production
defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'dev');

//定义分隔符、应用目录、应用命名空间
defined('DS') || define('DS', DIRECTORY_SEPARATOR);
//APP_ROOT 后缀不带/
defined('APP_ROOT') || define('APP_ROOT', dirname(__DIR__));

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../vendor/yiisoft/yii2/Yii.php';

$config = require __DIR__ . '/../config/web.php';
//http://basic.cc/index.php?r=gii
(new yii\web\Application($config))->run();
