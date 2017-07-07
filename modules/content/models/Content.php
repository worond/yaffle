<?php

namespace app\modules\content\models;

use app\modules\file\models\File;
use Yii;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\web\UploadedFile;

/**
 * This is the model class for table "{{%content}}".
 *
 * @property integer $id
 * @property integer $content_type_id
 * @property string $name
 * @property integer $active
 * @property integer $position
 * @property string $created
 *
 * @property ContentType $contentType
 * @property ContentValue[] $contentValues
 * @property ContentField[] $fields
 */
class Content extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%content}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['content_type_id', 'name'], 'required'],
            [['content_type_id', 'active', 'position'], 'integer'],
            [['created'], 'safe'],
            [['name'], 'string', 'max' => 255],
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
            'name' => 'Название',
            'active' => 'Активность',
            'position' => 'Позиция',
            'created' => 'Создан',
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
        return $this->hasMany(ContentValue::className(), ['content_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFields()
    {
        return $this->hasMany(ContentField::className(), ['id' => 'field_id'])->viaTable('{{%content_value}}', ['content_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return ContentQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ContentQuery(get_called_class());
    }

    public static function getContentTypeMenu()
    {
        $content_type = ContentType::find()->where(['active' => 1])->all();
        $menu = ArrayHelper::toArray($content_type, [
            'app\modules\content\models\ContentType' => [
                'label' => 'name',
                'icon' => function () {
                    return 'fa fa-circle-o';
                },
                'url' => function ($content_type) {
                    return [
                        '/admin/content/content/index',
                        'content_type_id' => $content_type->id
                    ];
                },
            ],
        ]);

        return $menu;

    }

    /**
     * @return ContentValue[]
     */
    public function initValues()
    {
        /** @var ContentValue[] $values */
        $values = $this->getContentValues()->with('field')->indexBy('field_id')->all();
        $fields = ContentField::find()->where(['content_type_id' => $this->contentType->id])->indexBy('id')->all();

        foreach (array_diff_key($fields, $values) as $field) {
            $values[$field->id] = new ContentValue(['field_id' => $field->id]);
        }

        return $values;
    }

    /**
     * @param ContentValue[] $values
     */
    public function processValues($values)
    {
        foreach ($values as $value) {
            $value->content_id = $this->id;
            if ($value->validate()) {
                if (!empty($value->value)) {
                    $value->save(false);
                } elseif ($value->field->type == ContentField::TYPE_IMAGE) {
                    //die(var_export($value->saveImage(File::PATH_IMAGE, false, "value","ContentValue[{$value->field_id}][image]"),1));
                    $value->saveImage(File::PATH_IMAGE, null, null, true, '[' . $value->field->id . ']imageFile', 'value');
                } else {
                    $value->delete();
                }
            }
        }
    }

    static function gridColumn($content_type_id)
    {
        $content_fields = ContentField::find()->where(['content_type_id' => $content_type_id, 'code' => 'image'])->one();
        if($content_fields){
            return [
                'label' => 'Изображение',
                'format' => 'raw',
                'value' => function (Content $data)  {
                    foreach ($data->contentValues as $value){
                        if($value->field->code = 'image'){
                            return Html::img($value->image->src, [
                                'alt' => $value->field->name,
                                'style' => 'width:100px;'
                            ]);
                        }
                    }
                    return false;
                },
            ];
        }
        return false;
    }
}
