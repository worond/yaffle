<?php
namespace app\modules\menu\widgets;

use app\modules\menu\models\Menu;
use yii\base\Widget;
use yii\helpers\Url;

class MenuWidget extends Widget
{
    public $category_id;
    public $options;

    public function init()
    {
        parent::init();
    }

    public function run()
    {
        /** @var Menu[] $models */
        $models = Menu::find()->where([
            'category_id' => $this->category_id,
            'active' => 1
        ])->orderBy(['position' => SORT_ASC])->all();

        foreach ($models as $model) {
            $items[] = [
                'label' => $model->name,
                'url' => $model->link,
                'active' => (Url::current() == $model->link ? true : false),
            ];
        }

        if (!empty($items)) {
            return \yii\widgets\Menu::widget([
                'items' => $items,
                'options' => $this->options,
            ]);
        }

        return false;
    }
}
