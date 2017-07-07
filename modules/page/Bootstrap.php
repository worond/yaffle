<?php
namespace app\modules\page;

use app\modules\page\models\Page;
use yii\base\BootstrapInterface;

class Bootstrap implements BootstrapInterface
{
    public function bootstrap($app)
    {
        /** @var Page[] $models */
        $models = Page::find()
            ->select(['id', 'url', 'action'])
            ->where(['active' => 1])
            ->andWhere(['is not', 'url', null])
            ->all();
        foreach ($models as $model) {
            if($model->url == '/index'){
                $model->url = '/';
            }
            $rules[] = [
                'pattern' => $model->url,
                'route' => 'page/site/' . $model->action,
                //'suffix' => '/',
                'defaults' => ['id' => $model->id],
            ];
        }

        $app->getUrlManager()->addRules($rules);
    }
}
