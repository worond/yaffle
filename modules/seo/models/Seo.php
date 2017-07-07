<?php

namespace app\modules\seo\models;


use yii\db\ActiveRecord;
use app\modules\page\models\Page;

/**
 * This is the model class for table "{{%seo}}".
 *
 * @property integer $id
 * @property string $title
 * @property string $description
 * @property string $keywords
 *
 * @property Page[] $pages
 */
class Seo extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%seo}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'description', 'keywords'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Заголовок',
            'description' => 'Описание',
            'keywords' => 'Ключи',
        ];
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPages()
    {
        return $this->hasMany(Page::className(), ['seo_id' => 'id']);
    }

    /**
     * @param string $link
     * @return array
     */
    public static function getSeoByLink($link)
    {
        if (!empty($link)) {
            $link = preg_replace('/(\?.*|\/\?.*|\/)$/', '', $link);
            $link = explode('/', $link);
            $link = array_pop($link);

            /** @var Page $model */
            $model = Page::find()->where(['code' => $link])->with('seo')->one();

            if ($model) {
                return [
                    'title' => $model->seo->title,
                    'description' => $model->seo->description,
                    'keywords' => $model->seo->keywords,
                ];
            }
        }

        return [];
    }

}
