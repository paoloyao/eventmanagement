<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Guest;

/**
 * GuestSampleSearch represents the model behind the search form of `common\models\GuestSample`.
 */
class GuestSearch extends Guest
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'phone', 'status'], 'integer'],
            [['first_name', 'last_name', 'email', 'address', 'events', 'gender'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
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
    public function search($params, $search)
    {
        if($search){
            $query = Guest::find()
                        ->andWhere(['first_name'=>$search[0]])
                        ->andWhere(['last_name'=>$search[1]]);
        }else{
            $query = Guest::find();
        }
       

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
            'phone' => $this->phone,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'first_name', $this->first_name])
            ->andFilterWhere(['like', 'last_name', $this->last_name])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'events', $this->events])
            ->andFilterWhere(['like', 'gender', $this->gender]);

        return $dataProvider;
    }
}
