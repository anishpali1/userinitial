<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\RequestLog;

/**
 * RequestlogSearch represents the model behind the search form about `app\models\RequestLog`.
 */
class RequestlogSearch extends RequestLog
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['action_path', 'get_data', 'post_data', 'return_data', 'request_time', 'return_time'], 'safe'],
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
        $query = RequestLog::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
             'sort'=> ['defaultOrder' => ['id'=>SORT_DESC]]
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
            'request_time' => $this->request_time,
            'return_time' => $this->return_time,
        ]);

        $query->andFilterWhere(['like', 'action_path', $this->action_path])
            ->andFilterWhere(['like', 'get_data', $this->get_data])
            ->andFilterWhere(['like', 'post_data', $this->post_data])
            ->andFilterWhere(['like', 'return_data', $this->return_data]);

        return $dataProvider;
    }
}
