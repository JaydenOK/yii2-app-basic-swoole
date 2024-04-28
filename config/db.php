<?php

return [
    'db' => [
        'class' => 'yii\db\Connection',
        'dsn' => 'mysql:host=localhost;dbname=basic',
        'username' => 'root',
        'password' => 'root',
        'charset' => 'utf8mb4',
        // Schema cache options (for production environment)
        //'enableSchemaCache' => true,
        //'schemaCacheDuration' => 60,
        //'schemaCache' => 'cache',
    ],
    'dbSlave' => [
        'class' => 'yii\db\Connection',
        'dsn' => 'mysql:host=localhost;dbname=basic',
        'username' => 'root',
        'password' => '12345678',
        'charset' => 'utf8mb4',
    ],
    'oms' => [
        'class' => 'yii\db\Connection',
        'dsn' => 'mysql:host=omsdbt.dev.yafex.cn;dbname=oms',
        'username' => 'apptest',
        'password' => 's0rUrOp9ba',
        'charset' => 'utf8mb4',
    ],
    'kms' => [
        'class' => 'yii\db\Connection',
        'dsn' => 'mysql:host=kmsdbt.dev.yafex.cn;dbname=kms',
        'username' => 'apptest',
        'password' => 'QC5UcBJRvpft',
        'charset' => 'utf8mb4',
    ],
];

