<?php

namespace app\modules\page\models\backend;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\page\models\Page;

/**
 * PageSearch represents the model behind the search form about `app\modules\page\models\Page`.
 */
class PageSearch extends Page
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'parent_id', 'image_id', 'seo_id', 'active', 'position', 'sitemap', 'views'], 'integer'],
            [['code', 'action', 'url', 'name', 'title', 'annotation', 'description'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Page::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'parent_id' => $this->parent_id,
            'image_id' => $this->image_id,
            'seo_id' => $this->seo_id,
            'active' => $this->active,
            'position' => $this->position,
            'sitemap' => $this->sitemap,
            'views' => $this->views,
        ]);

        $query->andFilterWhere(['like', 'code', $this->code])
            ->andFilterWhere(['like', 'action', $this->action])
            ->andFilterWhere(['like', 'url', $this->url])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'annotation', $this->annotation])
            ->andFilterWhere(['like', 'description', $this->description]);

        return $dataProvider;
    }
}