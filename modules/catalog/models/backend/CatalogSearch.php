<?php

namespace app\modules\catalog\models\backend;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\catalog\models\Catalog;

/**
 * CatalogSearch represents the model behind the search form about `app\modules\catalog\models\Catalog`.
 */
class CatalogSearch extends Catalog
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'category_id', 'image_id', 'seo_id', 'type_id', 'active'], 'integer'],
            [['code', 'name', 'title', 'annotation', 'description', 'article', 'created_at'], 'safe'],
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
        $query = Catalog::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => ['defaultOrder' => ['created_at' => SORT_DESC]],
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
            'type_id' => $this->type_id,
            'category_id' => $this->category_id,
            'image_id' => $this->image_id,
            'seo_id' => $this->seo_id,
            'active' => $this->active,
            'created_at' => $this->created_at,
        ]);

        $query->andFilterWhere(['like', 'code', $this->code])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'annotation', $this->annotation])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'article', $this->article]);

        return $dataProvider;
    }
}