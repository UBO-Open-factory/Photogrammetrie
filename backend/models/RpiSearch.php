<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Rpi;

/**
 * RpiSearch represents the model behind the search form of `app\models\Rpi`.
 */
class RpiSearch extends Rpi
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_rpi'], 'integer'],
            [['adresse_mac'], 'safe'],
            [['status'],'integer'],
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
    public function search($params)
    {
        $query = Rpi::find();

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
            'id_rpi' => $this->id_rpi,
            
        ]);

        $query->andFilterWhere(['like', 'adresse_mac', $this->adresse_mac]);

        return $dataProvider;
    }
}
