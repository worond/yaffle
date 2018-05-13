<?php

namespace app\modules\catalog\models;

use app\modules\admin\components\ImageHelper;
use app\modules\file\models\File;
use app\modules\seo\models\Seo;
use app\modules\user\models\User;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%catalog}}".
 *
 * @property integer $id
 * @property integer $category_id
 * @property integer $image_id
 * @property integer $brand_id
 * @property integer $type_id
 * @property integer $seo_id
 * @property string $code
 * @property string $name
 * @property string $title
 * @property string $annotation
 * @property string $description
 * @property string $article
 * @property string $grade
 * @property string $viscosity_grade
 * @property string $packaging
 * @property float $price
 * @property integer $active
 * @property string $created
 *
 * @property CatalogCategory $category
 * @property File $image
 * @property Seo $seo
 */
class Catalog extends ActiveRecord
{
    use ImageHelper;
    public $imageFile;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_catalog';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['category_id', 'brand_id', 'type_id', 'image_id', 'seo_id', 'active'], 'integer'],
            [['code', 'name'], 'required'],
            [['annotation', 'description'], 'string'],
            [['created_at', 'updated_at', 'price'], 'safe'],
            [['code', 'name', 'title', 'article', 'grade', 'viscosity_grade', 'packaging'], 'string', 'max' => 255],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => CatalogCategory::className(), 'targetAttribute' => ['category_id' => 'id']],
            [['image_id'], 'exist', 'skipOnError' => true, 'targetClass' => File::className(), 'targetAttribute' => ['image_id' => 'id']],
            [['seo_id'], 'exist', 'skipOnError' => true, 'targetClass' => Seo::className(), 'targetAttribute' => ['seo_id' => 'id']],
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
        return $this->hasOne(CatalogCategory::className(), ['id' => 'category_id']);
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
    public function getBrand()
    {
        return $this->hasOne(CatalogBrand::className(), ['id' => 'brand_id']);
    }
}
