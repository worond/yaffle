<?php

namespace app\modules\sector\models;

use app\modules\admin\components\AdminHelper;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%sector_category}}".
 *
 * @property integer $id
 * @property string $code
 * @property string $name
 * @property integer $active
 * @property integer $position
 *
 * @property Sector[] $sectors
 */
class SectorCategory extends ActiveRecord
{
    use AdminHelper;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%sector_category}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['code', 'name'], 'required'],
            [['active', 'position'], 'integer'],
            [['code', 'name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'code' => 'Псведоним',
            'name' => 'Название',
            'active' => 'Активность',
            'position' => 'Позиция',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSectors()
    {
        return $this->hasMany(Sector::className(), ['category_id' => 'id']);
    }
}