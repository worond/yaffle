<?php

namespace app\modules\catalog\models;

use app\modules\admin\components\AdminHelper;
use app\modules\file\models\File;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%catalog_property_value}}".
 *
 * @property integer $id
 * @property integer $type_id
 * @property string $value
 * @property integer $on_filter
 * @property integer $active
 * @property integer $position
 *
 * @property Catalog[] $products
 * @property CatalogPropertyType $type
 */
class CatalogPropertyValue extends ActiveRecord
{
    use AdminHelper;

    const CREATE = '/admin/catalog/catalog-property-value/create?CatalogPropertyValueSearch[type_id]=';
    const UPDATE = '/admin/catalog/catalog-property-value/update?CatalogPropertyValueSearch[type_id]=';
    const INDEX = '/admin/catalog/catalog-property-value/index?CatalogPropertyValueSearch[type_id]=';
    const DELETE = '/admin/catalog/catalog-property-value/delete?CatalogPropertyValueSearch[type_id]=';

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%catalog_property_value}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['on_filter', 'active', 'position', 'type_id'], 'integer'],
            [['value'], 'required'],
            [['value'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'value' => 'Значение',
            'on_filter' => 'Выводить в филтре',
            'active' => 'Активность',
            'position' => 'Позиция',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getType()
    {
        return $this->hasOne(CatalogPropertyType::className(), ['id' => 'type_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProducts()
    {
        return $this->hasMany(Catalog::className(), ['id' => 'catalog_id'])
            ->viaTable('catalog_property', ['value_id' => 'id']);
    }
}