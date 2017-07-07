<?php
namespace app\modules\parameter;

use yii\base\BootstrapInterface;
use app\modules\parameter\models\Parameter;

class Bootstrap implements BootstrapInterface
{
    public function bootstrap($app)
    {
        $app->params['global'] = Parameter::find()->select(['data', 'code'])->indexBy('code')->column();
        $files = Parameter::find()->where(['type' => 3])->indexBy('code')->all();
        foreach ($files as $code => $file) {
            $app->params['global'][$code] = $file;
        }
    }
}