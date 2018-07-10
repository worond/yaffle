<?php

namespace app\modules\catalog\models;

use app\modules\admin\components\ImageHelper;
use app\modules\file\models\File;
use app\modules\seo\models\Seo;
use app\modules\user\models\User;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;

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
 * @property string $created_at
 * @property string $updated_at
 *
 * @property CatalogPropertyValue $properties
 * @property CatalogProperty[] $dropDownLists
 * @property CatalogCategory $category
 * @property File $image
 * @property File[] $images
 * @property File[] $files
 * @property Seo $seo
 */
class Catalog extends ActiveRecord
{
    use ImageHelper;
    public $imageFile;

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => 'updated_at',
                'value' => new Expression('NOW()'),
            ],
        ];
    }

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
            [['category_id', 'type_id', 'image_id', 'seo_id', 'active'], 'integer'],
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
            'category_id' => 'Категория',
            'type_id' => 'Тип',
            'image_id' => 'Изображение',
            'seo_id' => 'СЕО',
            'code' => 'Псевдоним',
            'name' => 'Название',
            'title' => 'Заголовок',
            'annotation' => 'Аннотация',
            'description' => 'Контент',
            'article' => 'Артикул',
            'grade' => 'Класс',
            'viscosity_grade' => 'Класс взякости',
            'packaging' => 'Фасовка',
            'price' => 'Цена',
            'active' => 'Активность',
            'created_at' => 'Дата создания',
            'updated_at' => 'Дата обновления',
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
    public function getImages()
    {
        return $this->hasMany(File::className(), ['id' => 'file_id'])
            ->viaTable('{{%catalog_image}}', ['catalog_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFiles()
    {
        return $this->hasMany(File::className(), ['id' => 'file_id'])
            ->viaTable('{{%catalog_file}}', ['catalog_id' => 'id']);
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
    public function getProperties()
    {
        return $this->hasMany(CatalogPropertyValue::className(), ['id' => 'value_id'])
            ->viaTable('{{%catalog_property}}', ['catalog_id' => 'id']);
    }

    public function getDropDownLists()
    {
        $dropDownLists = [];
        $catalogTypes = CatalogPropertyType::getGroupProperties();

        /** @var CatalogProperty[] $catalogPropertyRelations */
        $catalogPropertyRelations = CatalogProperty::find()
            ->where(['=', 'catalog_id', $this->id])
            ->with('value')
            ->all();

        foreach ($catalogTypes as $catalogTypeId => $catalogType) {
            foreach ($catalogPropertyRelations as $relation){
                if($catalogTypeId === $relation->value->type_id){
                    $relation->values = $catalogType['values'];
                    $relation->label = $catalogType['name'];
                    $dropDownLists[$catalogTypeId] = $relation;
                    break;
                }
            }

            if(!isset($dropDownLists[$catalogTypeId])){
                $relation = new CatalogProperty();
                $relation->values = $catalogType['values'];
                $relation->label = $catalogType['name'];
                $dropDownLists[$catalogTypeId] = $relation;
            }
        }

        return $dropDownLists;
    }
}
