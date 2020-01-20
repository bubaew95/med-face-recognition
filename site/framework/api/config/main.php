<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-api',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'api\controllers',
    'bootstrap' => ['log'],
    'modules' => [],
    'components' => [
        'request' => [
            'enableCookieValidation' => false,
            'enableCsrfValidation' => false,
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
            ],
        ],
        'response' => [
            'class' => 'yii\web\Response',
            'format'=>\yii\web\Response::FORMAT_JSON,
            'formatters' => [
                'json' => [
                    'class' => 'yii\web\JsonResponseFormatter',
                    'prettyPrint' => YII_DEBUG,
                ],
            ],
        ],
        'user' => [
            'identityClass' => 'api\models\Users',
            'enableAutoLogin' => false,
            'enableSession' => false,
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'enableStrictParsing' => true,
            'showScriptName' => false,
            'rules' => [ //upervision
                ['class' => 'yii\rest\UrlRule', 'controller' => 'medicalstaff'],
                ['class' => 'yii\rest\UrlRule', 'controller' => 'pacients'],
                ['class' => 'yii\rest\UrlRule', 'controller' => 'records'],
                ['class' => 'yii\rest\UrlRule', 'controller' => 'supervision'],
            ],
        ],
    ],
    'params' => $params,
];
