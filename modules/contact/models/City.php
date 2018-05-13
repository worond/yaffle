<?php

namespace app\modules\contact\models;

use app\modules\admin\components\AdminHelper;
use app\modules\admin\components\ImageHelper;
use app\modules\contact\models\Region;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%city}}".
 *
 * @property integer $id
 * @property integer $region_id
 * @property string $code
 * @property string $name
 * @property string $description
 * @property string $coordinates
 * @property string $external_link
 * @property integer $active
 * @property integer $position
 *
 * @property Region $region
 */
class City extends ActiveRecord
{
    use AdminHelper;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%city}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['region_id', 'position', 'active'], 'integer'],
            [['description'], 'string'],
            [['code', 'name', 'coordinates', 'external_link'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'region_id' => 'Регион',
            'code' => 'Псевдоним',
            'name' => 'Название',
            'description' => 'Описание',
            'coordinates' => 'Координаты',
            'external_link' => 'Ссылка',
            'position' => 'Позиция',
            'active' => 'Активность',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRegion()
    {
        return $this->hasOne(Region::className(), ['id' => 'region_id']);
    }
}