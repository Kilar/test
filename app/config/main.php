<?php
use app\lib\behaviors\RequestControl;
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'app\controllers',
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-app',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-app', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the frontend
            'class' => '\yii\redis\Session',
            'name' => 'advanced-app',
            'savePath' => '/tmp/session',
            //'sessionCollection' => 'f_session',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                    'logFile' => '@runtime/logs/'.date('Y-m-d').'.log',
                ],
            ],
        ],
        'errorHandler' => [
            'class' => 'app\lib\components\ErrorHandler',
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                [
                    'pattern' => 'test',
                    'route' => 'user/test',
                ],
                [
                    'pattern' => 'register',
                    'route' => 'user/register',
                ],
                [
                    'pattern' => 'login',
                    'route' => 'user/login',
                ],
            ],
        ],
    ],
    'params' => $params,
    'as requestControl' => [
        'class' => RequestControl::className(),
        'underTime' => 86400,
    ],
];
