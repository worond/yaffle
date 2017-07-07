<?php

namespace app\modules\news\models;

use app\modules\admin\components\ImageHelper;
use app\modules\file\models\File;
use app\modules\seo\models\Seo;
use app\modules\user\models\User;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%news}}".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $category_id
 * @property integer $image_id
 * @property integer $seo_id
 * @property string $code
 * @property string $name
 * @property string $title
 * @property string $annotation
 * @property string $description
 * @property string $author
 * @property string $external_link
 * @property integer $active
 * @property string $created
 *
 * @property NewsCategory $category
 * @property File $image
 * @property Seo $seo
 * @property User $user
 */
class News extends ActiveRecord
{
    use ImageHelper;
    public $imageFile;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_news';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'category_id', 'image_id', 'seo_id', 'active'], 'integer'],
            [['code', 'name'], 'required'],
            [['annotation', 'description'], 'string'],
            [['created'], 'safe'],
            [['code', 'name', 'title', 'author', 'external_link'], 'string', 'max' => 255],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => NewsCategory::className(), 'targetAttribute' => ['category_id' => 'id']],
            [['image_id'], 'exist', 'skipOnError' => true, 'targetClass' => File::className(), 'targetAttribute' => ['image_id' => 'id']],
            [['seo_id'], 'exist', 'skipOnError' => true, 'targetClass' => Seo::className(), 'targetAttribute' => ['seo_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
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
            'user_id' => 'Пользователь',
            'category_id' => 'Категория',
            'image_id' => 'Изображение',
            'seo_id' => 'СЕО',
            'code' => 'Псевдоним',
            'name' => 'Название',
            'title' => 'Заголовок',
            'annotation' => 'Аннотация',
            'description' => 'Контент',
            'author' => 'Автор',
            'external_link' => 'Ссылка',
            'active' => 'Активность',
            'created' => 'Дата создания',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(NewsCategory::className(), ['id' => 'category_id']);
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
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    public function beforeSave($insert)
    {
        if(!$this->created){
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