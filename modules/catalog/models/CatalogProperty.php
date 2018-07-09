<?php

namespace app\modules\catalog\models;

use app\modules\file\models\File;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%catalog_property}}".
 *
 * @property integer $catalog_id
 * @property integer $value_id
 *
 * @property CatalogPropertyValue $value
 * @property Catalog $catalog
 */
class CatalogProperty extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%catalog_property}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['catalog_id', 'value_id'], 'required'],
            [['catalog_id', 'value_id'], 'integer'],
            [['catalog_id'], 'exist', 'skipOnError' => true, 'targetClass' => Catalog::className(), 'targetAttribute' => ['catalog_id' => 'id']],
            [['value_id'], 'exist', 'skipOnError' => true, 'targetClass' => CatalogPropertyValue::className(), 'targetAttribute' => ['value_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'catalog_id' => 'Catalog ID',
            'value_id' => 'Value ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getValue()
    {
        return $this->hasOne(CatalogPropertyValue::className(), ['id' => 'value_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCatalog()
    {
        return $this->hasOne(Catalog::className(), ['id' => 'catalog_id']);
    }
}