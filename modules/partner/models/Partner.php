<?php

namespace app\modules\partner\models;

use app\modules\admin\components\ImageHelper;
use app\modules\file\models\File;
use app\modules\seo\models\Seo;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%partner}}".
 *
 * @property integer $id
 * @property integer $image_id
 * @property integer $seo_id
 * @property string $code
 * @property string $name
 * @property string $annotation
 * @property string $description
 * @property integer $on_main
 * @property integer $active
 * @property integer $position
 *
 * @property File $image
 * @property Seo $seo
 */
class Partner extends ActiveRecord
{
    use ImageHelper;

    public $imageFile;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%partner}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['image_id', 'seo_id', 'on_main', 'active', 'position'], 'integer'],
            [['name'], 'required'],
            [['description', 'annotation'], 'string'],
            [['name', 'code'], 'string', 'max' => 255],
            [['image_id'], 'exist', 'skipOnError' => true, 'targetClass' => File::className(), 'targetAttribute' => ['image_id' => 'id']],
            [['seo_id'], 'exist', 'skipOnError' => true, 'targetClass' => Seo::className(), 'targetAttribute' => ['seo_id' => 'id']],
            [['imageFile'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'image_id' => 'Изображение',
            'seo_id' => 'СЕО',
            'code' => 'Псевдоним',
            'name' => 'Заголовок',
            'description' => 'Опсиание',
            'annotation' => 'Аннотация',
            'on_main' => 'Показывать на главной',
            'active' => 'Активность',
            'position' => 'Позиция',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getImage()
    {
        return $this->hasOne(File::className(), ['id' => 'image_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSeo()
    {
        return $this->hasOne(Seo::className(), ['id' => 'seo_id']);
    }
}