<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Customers;

/**
 * CustomerSearch represents the model behind the search form about `app\models\Customers`.
 */
class CustomerSearch extends Customers
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['email', 'full_name', 'password', 'profile_picture', 'dob', 'access_token', 'fb_token', 'user_type', 'user_status','timezone', 'profile_status', 'created_date', 'modified_date'], 'safe'],
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
        $query = Customers::find();

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
            'dob' => $this->dob,
            'created_date' => $this->created_date,
            'modified_date' => $this->modified_date,
        ]);

        $query->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'full_name', $this->full_name])
            ->andFilterWhere(['like', 'password', $this->password])
            ->andFilterWhere(['like', 'profile_picture', $this->profile_picture])
            ->andFilterWhere(['like', 'access_token', $this->access_token])
            ->andFilterWhere(['like', 'fb_token', $this->fb_token])
            ->andFilterWhere(['like', 'user_type', 'CUSTOMER'])
            ->andFilterWhere(['like', 'user_status', $this->user_status])
            ->andFilterWhere(['like', 'profile_status', $this->profile_status]);

        return $dataProvider;
    }
}
