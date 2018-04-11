<?php

namespace app\modules\page\models;

use app\modules\admin\components\AdminHelper;
use app\modules\admin\components\ImageHelper;
use Yii;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;
use app\modules\file\models\File;
use app\modules\seo\models\Seo;


/**
 * This is the model class for table "{{%page}}".
 *
 * @property integer $id
 * @property integer $parent_id
 * @property integer $image_id
 * @property integer $seo_id
 * @property string $code
 * @property string $action
 * @property string $url
 * @property string $name
 * @property string $title
 * @property string $annotation
 * @property string $description
 * @property integer $active
 * @property integer $position
 * @property integer $sitemap
 * @property string $views
 *
 * @property File $image
 * @property Page $parent
 * @property Page[] $pages
 * @property Seo $seo
 */
class Page extends ActiveRecord
{
    use AdminHelper;
    use ImageHelper;
    public $imageFile;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%page}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['parent_id', 'image_id', 'seo_id', 'active', 'position', 'sitemap'], 'integer'],
            [['code', 'name'], 'required'],
            [['annotation', 'description'], 'string'],
            [['code', 'action', 'url', 'name', 'title', 'views'], 'string', 'max' => 255],
            [['image_id'], 'exist', 'skipOnError' => true, 'targetClass' => File::className(), 'targetAttribute' => ['image_id' => 'id']],
            [['parent_id'], 'exist', 'skipOnError' => true, 'targetClass' => Page::className(), 'targetAttribute' => ['parent_id' => 'id']],
            [['seo_id'], 'exist', 'skipOnError' => true, 'targetClass' => Seo::className(), 'targetAttribute' => ['seo_id' => 'id']],
            [['image'], 'file', 'skipOnEmpty' => true, 'extensions' => 'jpg,png'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'parent_id' => 'Родительская страница',
            'image_id' => 'Изображение',
            'seo_id' => 'СЕО',
            'code' => 'Псевдоним',
            'action' => 'Шаблон',
            'url' => 'Ссылка',
            'name' => 'Название',
            'title' => 'Заголовок',
            'annotation' => 'Краткое описание',
            'description' => 'Контент',
            'active' => 'Активность',
            'position' => 'Позиция',
            'sitemap' => 'Показывать на карте сайта',
            'views' => 'Просмотры',
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
    public function getSeo()
    {
        return $this->hasOne(Seo::className(), ['id' => 'seo_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParent()
    {
        return $this->hasOne(Page::className(), ['id' => 'parent_id']);
    }

    /**
     * @param int $root
     * @param int $active
     * @return ActiveRecord[]
     */
    public static function getChildren($root, $active = 1)
    {
        $children = static::find()
            ->where(['parent_id' => $root])
            ->andWhere(['active' => $active])
            ->orderBy(['position' => SORT_ASC])
            ->all();
        return $children;
    }

    public static function getPageTree($root = null)
    {
        $arrayPage = static::find()
            ->select(['id', 'code', 'name', 'title', 'parent_id'])
            ->where(['parent_id' => $root])
            ->orderBy(['position' => SORT_ASC])
            ->asArray()
            ->all();

        foreach ($arrayPage as $id => $page) {
            $arrayPage[$id]['children'] = self::getPageTree($page['id']);
        }

        return $arrayPage;
    }

    /**
     * @return array|null
     */
    public static function getActions()
    {
        $namespace = Yii::$app->getModule('page')->controllerNamespace;
        $methods = get_class_methods($namespace . '\SiteController');

        foreach ($methods as $method) {
            if (strpos($method, 'action') === 0 && $method !== 'actions') {
                $actionName = strtolower(trim(preg_replace('/([A-Z])/', '-$1', substr($method, 6)), '-'));
                $actions[$actionName] = $actionName;
            }
        }

        if (!empty($actions)) return $actions;
        return null;
    }

    /**
     * @return array
     */
    public function getBreadcrumbs()
    {
        $current = $this;

        while (true) {
            $breadcrumbs[] = [
                'label' => $current->name,
                'url' => [$current->url],
            ];
            $current = $current->parent;
            if (empty($current)) break;
        }

        $breadcrumbs[] = ['label' => 'Главная', 'url' => '/'];

        return array_reverse($breadcrumbs);
    }

    /**
     * @inheritdoc
     */
    public function beforeSave($insert)
    {
        $parent = $this->parent;
        if ($parent) {
            $this->url = $parent->url . '/' . $this->code;
        } else {
            $this->url = '/' . $this->code;
        }


        if (!$this->position || (isset($this->oldAttributes['parent_id']) && $this->oldAttributes['parent_id'] != $this->parent_id)) {
            if ($this->isNewRecord) {
                if ($this->parent_id) {
                    $max = Page::find()
                        ->where(['parent_id' => $this->parent_id])
                        ->max('position');
                } else {
                    $max = Page::find()
                        ->where(['is', 'parent_id', null])
                        ->max('position');
                }
            } else {
                if ($this->parent_id) {
                    $max = Page::find()
                        ->where(['parent_id' => $this->parent_id])
                        ->andWhere(['!=', 'id', $this->id])
                        ->max('position');
                } else {
                    $max = Page::find()
                        ->where(['is', 'parent_id', null])
                        ->andWhere(['!=', 'id', $this->id])
                        ->max('position');
                }
            }
            $this->position = ++$max;
        }

        return parent::beforeSave($insert); // TODO: Change the autogenerated stub
    }
}
