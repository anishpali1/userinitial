<?php

$params = require(__DIR__ . '/params.php');

$config = [
    'id' => 'basic',
//    'timeZone' => 'America/Los_Angeles', 
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'modules' => [
        'admin' => [
            'class' => 'app\modules\admin\Admin',
            'defaultRoute' => '/dashboard/index',
        ],
        'api' => [
            'class' => 'app\modules\api\Api',
        ],
    ],
    'on beforeRequest' => function () {        
        $user = Yii::$app->user->identity;
        if ($user && $user->timezone) {
            Yii::$app->setTimeZone($user->timezone);
        }
},
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'c9zg1l0eCOx_UXOMQMBL33wwJ6JQXdHC',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true, // for remember me checkbox to work in login
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => false,
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => 'smtp.gmail.com',  // e.g. smtp.mandrillapp.com or smtp.gmail.com
                'username' => 'alignminds.technologies@gmail.com',
                'password' => 'devAlign',
                'port' => '465', // Port 25 is a very common port too
                'encryption' => 'ssl',
            ]
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
             'class' => 'yii\web\UrlManager',
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [ '<action:(emailverification)>' => 'site/<action>',]
            
        ],
        
    ],
    'params' => $params,
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
