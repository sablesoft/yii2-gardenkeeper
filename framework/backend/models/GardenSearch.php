<?php

namespace backend\models;

use common\models\Land;
use common\models\Plant;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Garden;

/**
 * GardenSearch represents the model behind the search form of `common\models\Garden`.
 */
class GardenSearch extends Garden
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'land_id', 'plant_id', 'age', 'fertility', 'health'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
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
            [
                'attribute' => 'land_id',
                'value' => function ($model) {
                    /** @var GardenSearch $model */
                    return $model->landLabel;
                },
                'filter' => Land::getDropDownList()[0]
            ],
            [
                'attribute' => 'plant_id',
                'value' => function ($model) {
                    /** @var GardenSearch $model */
                    return $model->plantLabel;
                },
                'filter' => Plant::getDropDownList()[0]
            ],
            'age',
            'fertility',
            'health',

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
        $query = Garden::find();

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
            'land_id' => $this->land_id,
            'plant_id' => $this->plant_id,
            'age' => $this->age,
            'fertility' => $this->fertility,
            'health' => $this->health,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        return $dataProvider;
    }
}
