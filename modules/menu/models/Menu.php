<?php

namespace app\modules\menu\models;

use app\modules\admin\behaviors\AdminBehaviors;
use app\modules\admin\components\AdminHelper;
use Yii;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "{{%menu}}".
 *
 * @property integer $id
 * @property integer $parent_id
 * @property integer $category_id
 * @property string $name
 * @property string $link
 * @property integer $active
 * @property integer $position
 *
 * @property MenuCategory $category
 * @property Menu $parent
 * @property Menu[] $children
 */
class Menu extends ActiveRecord
{
    use AdminHelper;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%menu}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['parent_id', 'category_id', 'active', 'position'], 'integer'],
            [['name', 'link'], 'required'],
            [['name', 'link'], 'string', 'max' => 255],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => MenuCategory::className(), 'targetAttribute' => ['category_id' => 'id']],
            [['parent_id'], 'exist', 'skipOnError' => true, 'targetClass' => Menu::className(), 'targetAttribute' => ['parent_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'parent_id' => 'Родительский пункт',
            'category_id' => 'Тип меню',
            'name' => 'Название',
            'link' => 'Ссылка',
            'active' => 'Активность',
            'position' => 'Позиция',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(MenuCategory::className(), ['id' => 'category_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParent()
    {
        return $this->hasOne(Menu::className(), ['id' => 'parent_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getChildren()
    {
        return $this->hasMany(Menu::className(), ['parent_id' => 'id']);
    }
}
