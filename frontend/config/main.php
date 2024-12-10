<?php

$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);
use \yii\web\Request;
$baseUrl = str_replace('/frontend/web', '', (new Request)->getBaseUrl());
return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    'components' => [
        'session' => [
            'timeout' => 2000,
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'loginUrl' => ['/user/signin/login'],
            'enableAutoLogin' => TRUE,
            'identityCookie' => [
                'name' => '_frontendUser', // unique for frontend
                'path' => '/'  // correct path for the frontend app.
            ]
        ],
        'i18n' => [
            'translations' => [
                '*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@app/messages', // if advanced application, set @frontend/messages
                    'sourceLan'
                    . 'guage' => 'en',
                    'fileMap' => [],
                ],
            ],
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
        'errorHandler' => [
            'errorAction' => 'signin/error',
        ],
        'request' => [
            'cookieValidationKey' => 'oXbcAeLFqvAdMFRboE1WD6_YSACZ2tCC',
            'baseUrl' => $baseUrl,
        ],
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=' . DB_HOST . ';dbname=' . DB_DATABASE,
            'username' => DB_USER,
            'password' => DB_PASSWORD,
            'charset' => 'utf8',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            //            'useFileTransport' => true,
            'viewPath' => '@common/mail',
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => SMTP_HOST,
                'username' => SMTP_USER,
                'password' => SMTP_PASSWORD,
                'port' => SMTP_PORT,
                'encryption' => SMTP_ENCRYPTION,
            ],
        ],
        'urlManager' => [
            'baseUrl' => $baseUrl,
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                'loging' => 'signin/loging',
                'dashboard' => 'dashboard/index',
                'cluster' => 'dashboard/cluster',
                // 'logout' => 'signin/logout',
                // 'checksignupemailmob' => '/signin/signupdobregischeck',
                // 'forgot-password' => 'user/changepassword',
                // 'setting' => 'dashboard/changepassword',
                // 'user-create' => 'user/create',
                // 'user-list' => 'user/userlist',
                '/' => 'site/index',

            ],
        ],
    ],
    'params' => $params,
];
