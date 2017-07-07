<?php

namespace app\modules\content\models;

use app\modules\admin\components\ImageHelper;
use app\modules\file\models\File;
use Yii;
use yii\db\ActiveRecord;
use yii\web\UploadedFile;

/**
 * This is the model class for table "{{%content_value}}".
 *
 * @property integer $content_id
 * @property integer $field_id
 * @property string $value
 *
 * @property ContentField $field
 * @property File $image
 * @property Content $content
 */
class ContentValue extends ActiveRecord
{
    use ImageHelper;

    /**
     * @var UploadedFile
     */
    public $imageFile;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%content_value}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['content_id', 'field_id'], 'required'],
            [['content_id', 'field_id'], 'integer'],
            [['value'], 'safe'],
            [['field_id'], 'exist', 'skipOnError' => true, 'targetClass' => ContentField::className(), 'targetAttribute' => ['field_id' => 'id']],
            [['content_id'], 'exist', 'skipOnError' => true, 'targetClass' => Content::className(), 'targetAttribute' => ['content_id' => 'id']],
            [['imageFile'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'content_id' => 'Content ID',
            'field_id' => 'Field ID',
            'value' => 'Value',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getField()
    {
        return $this->hasOne(ContentField::className(), ['id' => 'field_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getContent()
    {
        return $this->hasOne(Content::className(), ['id' => 'content_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getImage()
    {
        return $this->hasOne(File::className(), ['id' => 'value']);
    }
}