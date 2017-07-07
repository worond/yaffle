<?php

namespace app\modules\news;

use app\modules\page\models\Page;
use Yii;
use yii\base\BootstrapInterface;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;

/**
 * admin module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'app\modules\news\controllers';

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }
}
