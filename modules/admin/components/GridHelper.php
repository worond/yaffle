<?php

namespace app\modules\admin\components;

use yii\helpers\Html;

trait GridHelper
{
    /**
     * @return array
     */
    public static function columnActive()
    {
        return [
            'attribute' => 'active',
            'format' => 'raw',
            'filter' => ['1' => 'Да', '0' => 'Нет'],
            'value' => function ($data) {
                if ($data->active) return '<i class="fa fa-check"></i>';
                else return '<i class="fa fa-times"></i>';
            },
        ];
    }

    /**
     * @param string $attribute
     * @param string $relation
     * @param string $width
     * @param string $alt
     * @return array
     */
    public static function columnImage($attribute = 'image_id', $relation = 'image', $width = '50px', $alt = 'name')
    {
        return [
            'attribute' => $attribute,
            'filter' => false,
            'format' => 'raw',
            'value' => function ($data) use ($relation, $width, $alt) {
                if ($data->$relation)
                    return Html::img($data->$relation->src, [
                        'alt' => $alt ? $data->$alt : '',
                        'style' => 'width:' . $width . ';'
                    ]);
                return false;
            },
        ];
    }
}
