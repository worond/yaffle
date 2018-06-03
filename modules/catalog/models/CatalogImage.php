<?php

namespace app\modules\catalog\models;

use app\modules\file\models\File;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%catalog_image}}".
 *
 * @property integer $catalog_id
 * @property integer $file_id
 *
 * @property File $file
 * @property Catalog $catalog
 */
class CatalogImage extends ActiveRecord
{
    public $imageFile;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%catalog_image}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['catalog_id', 'file_id'], 'required'],
            [['catalog_id', 'file_id'], 'integer'],
            [['file_id'], 'exist', 'skipOnError' => true, 'targetClass' => File::className(), 'targetAttribute' => ['file_id' => 'id']],
            [['catalog_id'], 'exist', 'skipOnError' => true, 'targetClass' => Catalog::className(), 'targetAttribute' => ['catalog_id' => 'id']],
            [['imageFile'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg', 'maxFiles' => 10],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'catalog_id' => 'Catalog ID',
            'file_id' => 'File ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFile()
    {
        return $this->hasOne(File::className(), ['id' => 'file_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCatalog()
    {
        return $this->hasOne(Catalog::className(), ['id' => 'catalog_id']);
    }
}