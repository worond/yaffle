<?php

namespace app\modules\catalog\models;

use app\modules\admin\components\AdminHelper;
use app\modules\file\models\File;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%catalog_property_type}}".
 *
 * @property integer $id
 * @property string $code
 * @property string $name
 * @property integer $on_filter
 * @property integer $active
 * @property integer $position
 *
 * @property CatalogPropertyValue[] $values
 */
class CatalogPropertyType extends ActiveRecord
{
    use AdminHelper;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%catalog_property_type}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['on_filter', 'active', 'position'], 'integer'],
            [['code', 'name'], 'required'],
            [['code', 'name'], 'string', 'max' => 255]
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
            'on_filter' => 'Выводить в филтре',
            'active' => 'Активность',
            'position' => 'Позиция',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getValues()
    {
        return $this->hasMany(CatalogPropertyValue::className(), ['type_id' => 'id']);
    }

    public static function getGroupProperties($on_filter = true)
    {
        $query = self::find();
        if ($on_filter) {
            $query->where(['on_filter' => 1]);
        }
        /** @var CatalogPropertyType[] $types */
        $types = $query->with('values')->orderBy('position')->all();

        if ($types) {
            $properties = [];
            foreach ($types as $type) {
                $properties[$type->id]['name'] = $type->name;
                foreach ($type->values as $value) {
                    $properties[$type->id]['values'][$value->id] = $value->value;
                }
            }
            return $properties;
        }
        return null;
    }
}