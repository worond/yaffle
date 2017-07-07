<?php

return [
    /* Database */
    'host' => "localhost",
    'username' => "yaffle",
    'password' => "123456",
    'dbname' => "yaffle",
    'tablePrefix' => "tbl_",

    /* Application */
    'cookieValidationKey' => "",
    'language' => 'ru',
    'timeZone' => "Asia/Irkutsk",

    /* Mail */
    'useFileTransport' => false,
    'transport' => [
        'class' => 'Swift_SmtpTransport',
        'host' => 'smtp.yandex.ru',
        'username' => 'do-not-reply@yandex.ru',
        'password' => '123456',
        'port' => '465',
        'encryption' => 'ssl',
    ]

];