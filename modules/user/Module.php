<?php

namespace app\modules\user;

use Yii;
use yii\console\Application;

/**
 * user module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * @var int
     */
    public $passwordResetTokenExpire = 3600;

    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'app\modules\user\controllers';

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        if (Yii::$app instanceof Application) {
            $this->controllerNamespace = 'app\modules\user\commands';
        }
    }
}
