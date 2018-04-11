<?php

return [
    'admin' => [
        'class' => 'app\modules\admin\Module',
        'modules' => [
            'page' => [
                'class' => 'app\modules\page\Module',
                'controllerNamespace' => 'app\modules\page\controllers\backend',
                'viewPath' => '@app/modules/page/views/backend',
            ],
            'menu' => [
                'class' => 'app\modules\menu\Module',
                'controllerNamespace' => 'app\modules\menu\controllers\backend',
                'viewPath' => '@app/modules/menu/views/backend',
            ],
            'parameter' => [
                'class' => 'app\modules\parameter\Module',
                'controllerNamespace' => 'app\modules\parameter\controllers\backend',
                'viewPath' => '@app/modules/parameter/views/backend',
            ],
            'file' => [
                'class' => 'app\modules\file\Module',
                'controllerNamespace' => 'app\modules\file\controllers\backend',
            ],
            'news' => [
                'class' => 'app\modules\news\Module',
                'controllerNamespace' => 'app\modules\news\controllers\backend',
                'viewPath' => '@app/modules/news/views/backend',
            ],
            'contact' => [
                'class' => 'app\modules\contact\Module',
                'controllerNamespace' => 'app\modules\contact\controllers\backend',
                'viewPath' => '@app/modules/contact/views/backend',
            ],
            'content' => [
                'class' => 'app\modules\content\Module',
                'controllerNamespace' => 'app\modules\content\controllers\backend',
                'viewPath' => '@app/modules/content/views/backend',
            ],
            'feedback' => [
                'class' => 'app\modules\feedback\Module',
                'controllerNamespace' => 'app\modules\feedback\controllers\backend',
                'viewPath' => '@app/modules/feedback/views/backend',
            ],
            'service' => [
                'class' => 'app\modules\service\Module',
                'controllerNamespace' => 'app\modules\service\controllers\backend',
                'viewPath' => '@app/modules/service/views/backend',
            ],
            'user' => [
                'class' => 'app\modules\user\Module',
                'controllerNamespace' => 'app\modules\user\controllers\backend',
                'viewPath' => '@app/modules/user/views/backend',
            ],
            'slider' => [
                'class' => 'app\modules\slider\Module',
                'controllerNamespace' => 'app\modules\slider\controllers\backend',
                'viewPath' => '@app/modules/slider/views/backend',
            ],
        ]
    ],
    'page' => [
        'class' => 'app\modules\page\Module',
        'controllerNamespace' => 'app\modules\page\controllers\frontend',
        'viewPath' => '@app/views',
    ],
    'news' => [
        'class' => 'app\modules\news\Module',
        'controllerNamespace' => 'app\modules\news\controllers\frontend',
        'viewPath' => '@app/modules/news/views/frontend',
    ],
    'file' => [
        'class' => 'app\modules\file\Module',
    ],

];
