<?php

namespace app\modules\contact\models;

use app\modules\admin\components\AdminHelper;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%store}}".
 *
 * @property integer $id
 * @property integer $city_id
 * @property string $code
 * @property string $name
 * @property string $description
 * @property string $coordinates
 * @property string $external_link
 * @property integer $active
 * @property integer $position
 *
 * @property City $city
 */
class Store extends ActiveRecord
{
    use AdminHelper;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%store}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['city_id', 'position', 'active'], 'integer'],
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
            'city_id' => 'Город',
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
    public function getCity()
    {
        return $this->hasOne(City::className(), ['id' => 'city_id']);
    }
}