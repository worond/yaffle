<?php

namespace app\modules\menu\models;

use app\modules\admin\components\AdminHelper;
use app\modules\admin\components\ImageHelper;
use app\modules\file\models\File;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;

/**
 * This is the model class for table "{{%menu_category}}".
 *
 * @property integer $id
 * @property integer $image_id
 * @property string $code
 * @property string $name
 * @property integer $active
 * @property integer $position
 *
 * @property Menu[] $menus
 * @property File $image
 */
class MenuCategory extends ActiveRecord
{
    use AdminHelper;
    use ImageHelper;
    public $imageFile;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%menu_category}}';
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
            'code' => 'Псевдоним',
            'name' => 'Название',
            'active' => 'Активность',
            'position' => 'Позиция',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMenus()
    {
        return $this->hasMany(Menu::className(), ['category_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getImage()
    {
        return $this->hasOne(File::className(), ['id' => 'image_id']);
    }
}