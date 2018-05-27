<?php

namespace app\modules\catalog\models\backend;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\catalog\models\CatalogPropertyValue;

/**
 * CatalogPropertyValueSearch represents the model behind the search form about `app\modules\catalog\models\CatalogPropertyValue`.
 */
class CatalogPropertyValueSearch extends CatalogPropertyValue
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'on_filter', 'active'], 'integer'],
            [['value'], 'safe'],
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
        $query = CatalogPropertyValue::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=> ['defaultOrder' => ['id' => SORT_ASC]],
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
            'on_filter' => $this->on_filter,
            'active' => $this->active,
        ]);

        $query->andFilterWhere(['like', 'name', $this->value]);

        return $dataProvider;
    }
}