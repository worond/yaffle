<?php

namespace app\modules\contact\models;

use app\modules\admin\components\ImageHelper;
use app\modules\file\models\File;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%contact}}".
 *
 * @property integer $id
 * @property integer $city_id
 * @property integer $image_id
 * @property string $code
 * @property string $address
 * @property string $phone
 * @property string $fax
 * @property string $email
 * @property string $director
 * @property string $managers
 * @property string $time
 * @property string $description
 * @property string $coordinates
 * @property string $external_link
 * @property integer $position
 * @property integer $active
 *
 * @property File $image
 * @property City $city
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
            [['city_id', 'image_id', 'default', 'position', 'active'], 'integer'],
            [['description', 'managers'], 'string'],
            [['code', 'address', 'phone', 'fax', 'email', 'director', 'time', 'coordinates', 'external_link'], 'string', 'max' => 255],
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
            'city_id' => 'Город',
            'image_id' => 'Изображение',
            'code' => 'Псевдоним',
            'address' => 'Адрес',
            'phone' => 'Телефон',
            'fax' => 'Факс',
            'email' => 'Email',
            'director' => 'Управляющий',
            'managers' => 'Контакты менеджеров',
            'time' => 'Врмя работы',
            'description' => 'Описание',
            'coordinates' => 'Координаты',
            'external_link' => 'Ссылка',
            'default' => 'Основной офис',
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

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCity()
    {
        return $this->hasOne(City::className(), ['id' => 'city_id']);
    }
}