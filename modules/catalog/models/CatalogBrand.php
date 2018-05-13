<?php

namespace app\modules\catalog\models;

use app\modules\admin\components\AdminHelper;
use app\modules\file\models\File;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%catalog_brand}}".
 *
 * @property integer $id
 * @property integer $image_id
 * @property string $code
 * @property string $name
 * @property integer $active
 * @property integer $position
 *
 * @property Catalog[] $catalog
 * @property File $image
 */
class CatalogBrand extends ActiveRecord
{
    use AdminHelper;
    public $imageFile;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%catalog_brand}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['image_id', 'active', 'position'], 'integer'],
            [['code', 'name'], 'required'],
            [['code', 'name'], 'string', 'max' => 255],
            [['image_id'], 'exist', 'skipOnError' => true, 'targetClass' => File::className(), 'targetAttribute' => ['image_id' => 'id']],
            [['imageFile'], 'exist', 'skipOnError' => true, 'targetClass' => File::className(), 'targetAttribute' => ['image_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'image_id' => 'Image ID',
            'code' => 'Code',
            'name' => 'Name',
            'active' => 'Active',
            'position' => 'Position',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCatalog()
    {
        return $this->hasMany(Catalog::className(), ['brand_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getImage()
    {
        return $this->hasOne(File::className(), ['id' => 'image_id']);
    }
}