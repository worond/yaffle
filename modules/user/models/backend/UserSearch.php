<?php

namespace app\modules\user\models\backend;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\user\models\User;

/**
 * UserSearch represents the model behind the search form about `app\modules\user\models\User`.
 */
class UserSearch extends User
{
    public $role;
    public $name;
    public $phone;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'status', 'created_at', 'updated_at'], 'integer'],
            [['username', 'auth_key', 'password_hash', 'password_reset_token', 'email', 'name', 'role', 'phone'], 'safe'],
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
        $query = User::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'attributes' => [
                    'username',
                    'name',
                    'phone',
                    'email',
                    'role',
                    'status',
                    'created_at',
                ]
            ]
        ]);

        $this->load($params);

        if ($this->role) {
            $query = $query->innerJoin('{{%auth_assignment}}', "{{%user}}.id = {{%auth_assignment}}.user_id");
        }

        if ($this->name || $this->phone) {
            $query = $query->innerJoin('{{%user_profile}}', "{{%user}}.id = {{%user_profile}}.user_id");
        }

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            '{{%auth_assignment}}.item_name' => $this->role
        ]);

        $query->andFilterWhere(['like', 'username', $this->username])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', '{{%user_profile}}.name', $this->name])
            ->andFilterWhere(['like', '{{%user_profile}}.phone', $this->phone]);

        return $dataProvider;
    }
}
