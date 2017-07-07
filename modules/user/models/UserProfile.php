<?php

namespace app\modules\user\models;

use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%user_profile}}".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $image_id
 * @property string $name
 * @property string $birthday
 * @property integer $discount
 * @property string $phone
 * @property string $exported
 *
 * @property User $user
 */
class UserProfile extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%user_profile}}';
    }

    const DATE_FORMAT = 'yyyy-mm-dd';

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id'], 'required'],
            [['user_id', 'image_id', 'discount'], 'integer'],
            [['birthday'], 'safe'],
            [['name', 'phone'], 'string', 'max' => 255],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'Пользователь',
            'image_id' => 'Аватар',
            'name' => 'Имя',
            'birthday' => 'Дата рождения',
            'discount' => 'Скидка',
            'phone' => 'Телефон',

        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
