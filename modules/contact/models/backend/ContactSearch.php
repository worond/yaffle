<?php

namespace app\modules\contact\models\backend;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\contact\models\Contact;

/**
 * ContactSearch represents the model behind the search form about `app\modules\contact\models\Contact`.
 */
class ContactSearch extends Contact
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'city_id', 'image_id', 'default', 'position', 'active'], 'integer'],
            [['code', 'address', 'phone', 'email', 'time', 'description', 'coordinates', 'external_link'], 'safe'],
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
        $query = Contact::find();

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
            'city_id' => $this->city_id,
            'image_id' => $this->image_id,
            'position' => $this->position,
            'active' => $this->active,
        ]);

        $query->andFilterWhere(['like', 'code', $this->code])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'phone', $this->phone])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'time', $this->time])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'coordinates', $this->coordinates])
            ->andFilterWhere(['like', 'external_link', $this->external_link]);

        return $dataProvider;
    }
}