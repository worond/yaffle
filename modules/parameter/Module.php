<?php

namespace app\modules\parameter;

/**
 * parameter module definition class
 */
class Module extends \yii\base\Module
{
    public $parameters;

    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'app\modules\parameter\controllers';

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }
}
