<?php

$appConfig = require(__DIR__ . '/app_config.php');

return [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host='.$appConfig['host'].';dbname='.$appConfig['dbname'],
    'username' => $appConfig['username'],
    'password' => $appConfig['password'],
    'charset' => 'utf8',
    'tablePrefix' => $appConfig['tablePrefix'],
    'enableSchemaCache' => true,
];
