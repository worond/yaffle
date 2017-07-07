<?php

namespace app\modules\project\models;

use app\modules\admin\components\ImageHelper;
use app\modules\file\models\File;
use app\modules\seo\models\Seo;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%project}}".
 *
 * @property integer $id
 * @property integer $category_id
 * @property integer $image_id
 * @property integer $icon_id
 * @property integer $thumbnail_id
 * @property integer $seo_id
 * @property string $code
 * @property string $name
 * @property string $title_menu
 * @property string $title
 * @property string $annotation
 * @property string $description
 * @property string $external_link
 * @property integer $active
 * @property string $created
 *
 * @property ProjectCategory $category
 * @property File $icon
 * @property File $image
 * @property Seo $seo
 * @property File $thumbnail
 * @property ProjectImage[] $projectImages
 * @property File[] $files
 */
class Project extends ActiveRecord
{
    use ImageHelper;

    public $imageFile;
    public $iconFile;
    public $thumbnailFile;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%project}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['category_id', 'image_id', 'icon_id', 'thumbnail_id', 'seo_id', 'active'], 'integer'],
            [['code', 'name'], 'required'],
            [['annotation', 'description'], 'string'],
            [['created'], 'safe'],
            [['code', 'name', 'title_menu', 'title', 'external_link'], 'string', 'max' => 255],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => ProjectCategory::className(), 'targetAttribute' => ['category_id' => 'id']],
            [['icon_id'], 'exist', 'skipOnError' => true, 'targetClass' => File::className(), 'targetAttribute' => ['icon_id' => 'id']],
            [['image_id'], 'exist', 'skipOnError' => true, 'targetClass' => File::className(), 'targetAttribute' => ['image_id' => 'id']],
            [['seo_id'], 'exist', 'skipOnError' => true, 'targetClass' => Seo::className(), 'targetAttribute' => ['seo_id' => 'id']],
            [['thumbnail_id'], 'exist', 'skipOnError' => true, 'targetClass' => File::className(), 'targetAttribute' => ['thumbnail_id' => 'id']],
            [['imageFile'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg'],
            [['iconFile'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg'],
            [['thumbnailFile'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'category_id' => 'Раздел',
            'image_id' => 'Изображение',
            'icon_id' => 'Иконка',
            'thumbnail_id' => 'Превью',
            'seo_id' => 'СЕО',
            'code' => 'Псевдоним',
            'name' => 'Название',
            'title_menu' => 'Название в меню',
            'title' => 'Заголовок',
            'annotation' => 'Аннотация',
            'description' => 'Контент',
            'external_link' => 'Ссылка',
            'active' => 'Активность',
            'created' => 'Дата',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(ProjectCategory::className(), ['id' => 'category_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIcon()
    {
        return $this->hasOne(File::className(), ['id' => 'icon_id']);
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

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getThumbnail()
    {
        return $this->hasOne(File::className(), ['id' => 'thumbnail_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProjectImages()
    {
        return $this->hasMany(ProjectImage::className(), ['project_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFiles()
    {
        return $this->hasMany(File::className(), ['id' => 'file_id'])->viaTable('{{%project_image}}', ['project_id' => 'id']);
    }

    /**
     * @inheritdoc
     */
    public function beforeSave($insert)
    {
        if (!$this->created) {
            $this->created = date('Y-m-d H:i:s');
        } else {
            if ($date = date_create_from_format('d.m.Y', $this->created)) {
                $this->created = date_format($date, 'Y-m-d H:i:s');
            } else {
                $this->created = $this->oldAttributes['created'];
            }
        }
        return parent::beforeSave($insert); // TODO: Change the autogenerated stub
    }
}