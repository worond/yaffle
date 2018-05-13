<?php

namespace app\modules\contact\models;

use app\modules\admin\components\AdminHelper;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%region}}".
 *
 * @property integer $id
 * @property string $code
 * @property string $name
 * @property string $description
 * @property string $coordinates
 * @property integer $active
 * @property integer $position
 *
 */
class Region extends ActiveRecord
{
    use AdminHelper;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%region}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['position', 'active'], 'integer'],
            [['description'], 'string'],
            [['code', 'name', 'coordinates'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'code' => 'Псевдоним',
            'name' => 'Название',
            'description' => 'Описание',
            'coordinates' => 'Координаты',
            'position' => 'Позиция',
            'active' => 'Активность',
        ];
    }
}