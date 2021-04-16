<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Plant;

/**
 * PlantSearch represents the model behind the search form of `common\models\Plant`.
 */
class PlantSearch extends Plant
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'lifespan', 'temperature_min', 'temperature_max', 'humidity_min', 'humidity_max', 'precipitation_min', 'precipitation_max', 'sunshine_min', 'sunshine_max', 'wind_min', 'wind_max'], 'integer'],
            [['name', 'created_at', 'updated_at'], 'safe'],
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
     * @return array
     */
    public function getColumns(): array
    {
        return [
            ['class' => 'yii\grid\SerialColumn'],

//            'id',
            'name',
            'lifespan',
//            'temperature_min',
//            'temperature_max',
//            'humidity_min',
//            'humidity_max',
//            'precipitation_min',
//            'precipitation_max',
//            'sunshine_min',
//            'sunshine_max',
//            'wind_min',
//            'wind_max',
            [
                'attribute' => 'created_at',
                'format' => 'datetime',
                'filter' => false
            ],
            [
                'attribute' => 'updated_at',
                'format' => 'datetime',
                'filter' => false
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ];
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
        $query = Plant::find();

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
            'lifespan' => $this->lifespan,
            'temperature_min' => $this->temperature_min,
            'temperature_max' => $this->temperature_max,
            'humidity_min' => $this->humidity_min,
            'humidity_max' => $this->humidity_max,
            'precipitation_min' => $this->precipitation_min,
            'precipitation_max' => $this->precipitation_max,
            'sunshine_min' => $this->sunshine_min,
            'sunshine_max' => $this->sunshine_max,
            'wind_min' => $this->wind_min,
            'wind_max' => $this->wind_max,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name]);

        return $dataProvider;
    }
}
