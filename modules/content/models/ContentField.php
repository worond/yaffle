<?php

namespace app\modules\content\models;

use Yii;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "{{%content_field}}".
 *
 * @property integer $id
 * @property integer $content_type_id
 * @property string $code
 * @property string $name
 * @property integer $type
 * @property integer $position
 * @property integer $active
 * @property integer $grid
 *
 * @property ContentType $contentType
 * @property ContentValue[] $contentValues
 * @property Content[] $contents
 *
 * @property mixed $typeName
 */
class ContentField extends ActiveRecord
{
    const TYPE_INTEGER = 0;
    const TYPE_STRING = 1;
    const TYPE_CHECKBOX = 2;
    const TYPE_TEXT = 3;
    const TYPE_IMAGE = 4;

    public static function getTypesArray()
    {
        return [
            self::TYPE_INTEGER => 'Число',
            self::TYPE_STRING => 'Строка',
            self::TYPE_CHECKBOX => 'Чекбокс',
            self::TYPE_TEXT => 'Текст',
            self::TYPE_IMAGE => 'Изображение',
        ];
    }

    public function getTypeName()
    {
        return ArrayHelper::getValue(self::getTypesArray(), $this->type);
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%content_field}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['content_type_id', 'code', 'name', 'type'], 'required'],
            [['content_type_id', 'type', 'position', 'active','grid'], 'integer'],
            [['code', 'name'], 'string', 'max' => 255],
            [['content_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => ContentType::className(), 'targetAttribute' => ['content_type_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'content_type_id' => 'Тип контента',
            'code' => 'Псевдоним',
            'name' => 'Название',
            'type' => 'Тип',
            'position' => 'Позиция',
            'active' => 'Активность',
            'grid' => 'Выводить в списке',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getContentType()
    {
        return $this->hasOne(ContentType::className(), ['id' => 'content_type_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getContentValues()
    {
        return $this->hasMany(ContentValue::className(), ['field_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getContents()
    {
        return $this->hasMany(Content::className(), ['id' => 'content_id'])->viaTable('{{%content_value}}', ['field_id' => 'id']);
    }
}
