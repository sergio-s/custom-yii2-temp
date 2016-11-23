<?php

$params = require(__DIR__ . '/params.php');
$db = require(__DIR__ . '/db.php');

$config = [
    'id' => 'console',
    'basePath' => dirname(__DIR__).'/app',
    'runtimePath' => dirname(__DIR__).'/runtime',
    'vendorPath' => dirname(__DIR__).'/vendor',
    'bootstrap' => [
        'log'
    ],
    'aliases' => [
        'db' => dirname(__DIR__).'/db'
    ],
    'controllerNamespace' => 'app\commands',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'log' => [
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => $db,
    ],
    'params' => $params,
    'controllerMap' => [
        'migrate' => [
            'class' => 'yii\console\controllers\MigrateController',
            'migrationNamespaces' => [
               'db\migrations',
            ],
            'migrationPath' => null,
        ],
    ],
    'modules' => [
        'user' => [
            'class' => 'dektrium\user\Module',
        ],
        'rbac' => [
            'class' => 'dektrium\rbac\RbacConsoleModule'
        ],
    ]
];

if (YII_DEBUG) {
    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        'allowedIPs' => ['*'],
    ];
}

return $config;
