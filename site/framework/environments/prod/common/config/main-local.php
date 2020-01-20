<?php
return [
    'components' => [
        'db' => [ 
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=localhost;dbname=medical',
            'username' => 'root',
            'password' => '123',
            'charset' => 'utf8',
            // 'tablePrefix' => 'med_',
            'enableSchemaCache' => false,
            'schemaCacheDuration' => 3600,
            'schemaCache' => 'cache',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'viewPath' => '@common/mail',
        ],
    ],
];
