<?php

$params = require(__DIR__ . '/params.php');

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__).'/app',
    'runtimePath' => dirname(__DIR__).'/runtime',
    'vendorPath' => dirname(__DIR__).'/vendor',
    'extensions' => require dirname(__DIR__ ).'/vendor/yiisoft/extensions.php',
    'bootstrap' => [
        'log'
    ],
    'aliases' => [
        'modules' => dirname(__DIR__).'/modules'
    ],
    'language' => 'ru-RU',
    'sourceLanguage' => 'ru-RU',
    'components' => [
        'request' => [
            'cookieValidationKey' => getenv('COOKIE_VALIDATION_KEY'),
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
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
        'db' => require(__DIR__ . '/db.php'),
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
        'view' => [
            'theme' => [
                'pathMap' => [
                    '@dektrium/user/views' => '@modules/admin/views/user',
                    '@dektrium/rbac/views' => '@modules/admin/views/rbac'
                ],
            ],
        ],
        'i18n' => [
            'translations' => [
                'rbac*' => [
                    'sourceLanguage' => 'en-US',
                    'class'    => 'yii\i18n\PhpMessageSource',
                    'basePath' => __DIR__ . '/messages',
                ],
                'user*' => [
                    'sourceLanguage' => 'en-US',
                    'class'    => 'yii\i18n\PhpMessageSource',
                    'basePath' => __DIR__ . '/messages',
                ],
            ],
        ],
    ],
    'modules' => [
        'admin' => [
            'class' => 'modules\admin\Admin',
        ],
        'user' => [
            'class' => 'dektrium\user\Module',
            'enableUnconfirmedLogin' => true,
            'confirmWithin' => 21600,
            'cost' => 12,
            'admins' => ['admin'],
            'adminPermission' => 'admin',
            'modelMap' => [
                'User' => 'app\models\User',
                'Profile' => 'app\models\Profile',
            ],
            'controllerMap' => [
                'admin' => [
                    'class'  => 'dektrium\user\controllers\AdminController',
                    'layout' => '@modules/admin/views/layouts/main',
                ],
            ],
        ],
        'rbac' => [
            'class' => 'dektrium\rbac\RbacWebModule',
            'controllerMap' => [
                'role' => [
                    'class'  => 'dektrium\rbac\controllers\RoleController',
                    'layout' => '@modules/admin/views/layouts/main',
                ],
                'permission' => [
                    'class'  => 'dektrium\rbac\controllers\PermissionController',
                    'layout' => '@modules/admin/views/layouts/main',
                ],
                'rule' => [
                    'class'  => 'dektrium\rbac\controllers\RuleController',
                    'layout' => '@modules/admin/views/layouts/main',
                ],
            ],
        ]
    ],
    'params' => $params,
];

if (YII_DEBUG) {
    $config['bootstrap'][] = 'debug';
    $config['bootstrap'][] = 'gii';
    $config['modules']['debug'] = [
        'class'=>'yii\debug\Module',
        'allowedIPs' => ['*'],
    ];
    $config['modules']['gii'] = [
        'class'=>'yii\gii\Module',
        'allowedIPs' => ['*'],
    ];
}

return $config;
