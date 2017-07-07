<?php
namespace app\modules\content\widgets;

use Yii;
use yii\base\Widget;
use yii\data\ActiveDataProvider;
use app\modules\content\models\Content;
use yii\widgets\ListView;

class ContentListWidget extends Widget
{
    const VIEW_PATH = '@app/modules/content/widgets/views/';
    public $content_type_id;
    public $options;
    public $template = null;

    public function init()
    {
        parent::init();
    }

    public function run()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Content::find()->where(['content_type_id' => $this->content_type_id, 'active' => 1])->withAttributes(),
            'sort' => ['defaultOrder' => ['position' => SORT_ASC]],
        ]);

        return ListView::widget([
            'dataProvider' => $dataProvider,
            'layout' => "{items}",
            'options' => $this->options,
            //'itemView' => self::VIEW_PATH . ($this->template ? $this->template : 'default'),
            'itemView' => function ($model, $key, $index, $widget) {
                return $this->render(self::VIEW_PATH . ($this->template ? $this->template : 'default'), ['model' => $model]);
            },
            'itemOptions' => [
                'tag' => false,
            ],
        ]);
    }
}