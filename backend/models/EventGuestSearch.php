<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\EventGuest;

/**
 * EventGuestSearch represents the model behind the search form of `backend\models\EventGuest`.
 */
class EventGuestSearch extends EventGuest
{
    /**
     * {@inheritdoc}
     */
    public $email;
    public $first_name;
    public $last_name;
    public $phone;
    public function rules()
    {
        return [
            [['id', 'event_id', 'guest_id'], 'integer'],
            [['email', 'first_name', 'last_name', 'phone'], 'safe']
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
    public function search($params, $group_id)
    {
        $query = EventGuest::find()
                 ->joinWith(['guest'])
                 ->where(['eventguest.event_id' => $group_id]);
        // $query->select('eventguest.event_id as id, guest.first_name as first_name, guest.last_name as last_name, guest.phone as phone, guest.email as email')
        //     ->leftJoin('guest', 'guest.id = eventguest.guest_id');
        // $query->joinWith(['guest']);
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
            'event_id' => $this->event_id,
            'guest_id' => $this->guest_id,
            'email' => $this->email,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'phone' => $this->phone 
        ]);

        return $dataProvider;
    }

    public function searchEventGuest($params)
    {
        $query = EventGuest::find();

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
            'event_id' => $this->event_id,
            'guest_id' => $this->guest_id,
            'phone' => $this->phone,
            'email' => $this->email,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name
        ]);

        return $dataProvider;
    }
}
