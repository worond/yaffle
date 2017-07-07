<?php

namespace app\modules\contact\models;

use app\modules\admin\components\ImageHelper;
use app\modules\file\models\File;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%contact}}".
 *
 * @property integer $id
 * @property integer $image_id
 * @property string $code
 * @property string $city
 * @property string $address
 * @property string $phone
 * @property string $email
 * @property string $time
 * @property string $description
 * @property string $coordinates
 * @property string $external_link
 * @property integer $position
 * @property integer $active
 *
 * @property File $image
 */
class Contact extends ActiveRecord
{
    use ImageHelper;

    public $imageFile;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%contact}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['image_id', 'position', 'active'], 'integer'],
            [['description'], 'string'],
            [['code', 'city', 'address', 'phone', 'email', 'time', 'coordinates', 'external_link'], 'string', 'max' => 255],
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
            'image_id' => 'Изображение',
            'code' => 'Псевдоним',
            'city' => 'Город',
            'address' => 'Адрес',
            'phone' => 'Телефон',
            'email' => 'Email',
            'time' => 'Врмя работы',
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
    public function getImage()
    {
        return $this->hasOne(File::className(), ['id' => 'image_id']);
    }
}