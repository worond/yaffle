<?php

namespace app\modules\content\models;

use Yii;

/**
 * This is the model class for table "{{%content_type}}".
 *
 * @property integer $id
 * @property string $code
 * @property string $name
 * @property string $description
 * @property integer $active
 * @property integer $position
 * @property string $created
 *
 * @property Content[] $contents
 * @property ContentField[] $contentFields
 */
class ContentType extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%content_type}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['code', 'name'], 'required'],
            [['description'], 'string'],
            [['active', 'position'], 'integer'],
            [['created'], 'safe'],
            [['code', 'name'], 'string', 'max' => 255],
            [['code'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'code' => 'Псевдоним',
            'name' => 'Название',
            'description' => 'Описание',
            'active' => 'Активность',
            'position' => 'Позиция',
            'created' => 'Создан',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getContents()
    {
        return $this->hasMany(Content::className(), ['content_type_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getContentFields()
    {
        return $this->hasMany(ContentField::className(), ['content_type_id' => 'id']);
    }
}
