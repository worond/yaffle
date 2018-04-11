<?php

namespace app\modules\slider\models;

use app\modules\admin\components\ImageHelper;
use app\modules\file\models\File;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%slider}}".
 *
 * @property integer $id
 * @property integer $type
 * @property integer $image_id
 * @property integer $icon_id
 * @property string $name
 * @property string $description
 * @property string $link
 * @property integer $active
 * @property integer $position
 *
 * @property File $icon
 * @property File $image
 * @property File[] $files
 */
class Slider extends ActiveRecord
{
    use ImageHelper;

    public $imageFile;
    public $iconFile;

    const TYPE_MAIN = 1;

    public static function getTypesList()
    {
        return [
            self::TYPE_MAIN => 'Слайдер на главной'
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%slider}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type', 'image_id', 'icon_id', 'active', 'position'], 'integer'],
            [['name'], 'required'],
            [['description'], 'string'],
            [['created'], 'safe'],
            [['name', 'link'], 'string', 'max' => 255],
            [['icon_id'], 'exist', 'skipOnError' => true, 'targetClass' => File::className(), 'targetAttribute' => ['icon_id' => 'id']],
            [['image_id'], 'exist', 'skipOnError' => true, 'targetClass' => File::className(), 'targetAttribute' => ['image_id' => 'id']],

            [['imageFile'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg'],
            [['iconFile'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'type' => 'Тип',
            'image_id' => 'Изображение',
            'icon_id' => 'Иконка',
            'name' => 'Заголовок',
            'description' => 'Опсиание',
            'link' => 'Ссылка',
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
    public function getIcon()
    {
        return $this->hasOne(File::className(), ['id' => 'icon_id']);
    }

    public function getTypeName()
    {
        $types_list = self::getTypesList();

        return $types_list[$this->type];
    }
}